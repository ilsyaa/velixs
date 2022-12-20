<?php
// Build By Ilsya 2022
// Path: app\Helpers\Notify.php
// Compare this snippet from app\Http\Controllers\Api\PrivateController.php:
// Github : github.com/ilsyaa

namespace App\Helpers;

class Notify
{
    public static $path_json = 'app\notify.json';
    private static $where = '', $orderby = '';

    private static function json_path()
    {
        $path = storage_path(self::$path_json);
        if (!file_exists($path)) {
            file_put_contents($path, json_encode([]));
        }
        return $path;
    }

    public static function increments()
    {
        $data = json_decode(file_get_contents(self::json_path()), true);
        // get last id
        $last_id = 0;
        if ($data) {
            foreach ($data as $key => $value) {
                if ($value['id'] > $last_id) {
                    $last_id = $value['id'];
                }
            }
        }
        return $last_id + 1;
    }

    public static function insert($data = [])
    {
        $json = json_decode(file_get_contents(self::json_path()), true);
        $json[] = $data;
        file_put_contents(self::json_path(), json_encode($json, JSON_PRETTY_PRINT));
    }

    public static function get()
    {
        $data = json_decode(file_get_contents(self::json_path()), true);
        if (self::$where != '') {
            $data = array_filter($data, function ($item) {
                return $item[self::$where['key']] == self::$where['value'];
            });
        }
        if (self::$orderby) {
            if (self::$orderby['value'] == 'asc') {
                usort($data, function ($a, $b) {
                    return $a[self::$orderby['key']] <=> $b[self::$orderby['key']];
                });
            } else {
                usort($data, function ($a, $b) {
                    return $b[self::$orderby['key']] <=> $a[self::$orderby['key']];
                });
            }
        }
        return $data;
    }

    public static function delete($id = null)
    {
        $data = json_decode(file_get_contents(self::json_path()), true);
        if (self::$where != '') {
            $data = array_filter($data, function ($item) {
                return $item[self::$where['key']] != self::$where['value'];
            });
        } else {
            if ($id == null) {
                $data = [];
            } else {
                $data = array_filter($data, function ($item) use ($id) {
                    return $item['id'] != $id;
                });
            }
        }

        file_put_contents(self::json_path(), json_encode($data, JSON_PRETTY_PRINT));
    }

    public static function update($data = [], $id)
    {
        $json = json_decode(file_get_contents(self::json_path()), true);
        $json = array_map(function ($item) use ($data, $id) {
            if ($item['id'] == $id) {
                return array_merge($item, $data);
            }
            return $item;
        }, $json);
        file_put_contents(self::json_path(), json_encode($json, JSON_PRETTY_PRINT));
    }

    public static function where($key, $value): object
    {
        self::$where = [
            'key' => $key,
            'value' => $value
        ];
        return new self;
    }

    public static function orderBy($key, $value): object
    {
        self::$orderby = [
            'key' => $key,
            'value' => $value
        ];
        return new self;
    }
}
