<?php

namespace App\Http\Livewire\Front\Product;

use App\Models\ProductComment;
use Livewire\Component;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;

class Comments extends Component
{
    use WithRateLimiting;
    public $product, $comment, $parent_id, $comments, $auth_user;

    public function render()
    {
        return view('livewire.front.product.comments');
    }

    public function setValue($id, $comment)
    {
        $this->comment = $comment;
        $this->parent_id = $id;
    }

    public function destroy($id)
    {
        ProductComment::where(['id' => $id, 'user_id' => $this->auth_user->id])->delete();
        ProductComment::where(['parent_id' => $id])->delete();
        $this->emit('toast', ['message' => '<i class="bi bi-check2-all"></i> Comment deleted successfully']);
    }

    public function reply()
    {
        try {
            $this->rateLimit(2);
            $this->validate([
                'comment' => 'required',
            ]);
            if (config('app.review_comment') == 1) {
                if ($this->auth_user->role == 'user') {
                    $status = 'pending';
                } else {
                    $status = 'approved';
                }
                $this->product->comments()->create([
                    'comment' => $this->comment,
                    'parent_id' => $this->parent_id,
                    'user_id' => $this->auth_user->id,
                    'status' => $status
                ]);
            } else {
                $this->product->comments()->create([
                    'comment' => $this->comment,
                    'parent_id' => $this->parent_id,
                    'user_id' => $this->auth_user->id,
                    'status' => 'approved'
                ]);
            }
            $this->comment = '';
            $this->parent_id = '';
            if (config('app.review_comment') == 1) {
                if ($status == 'pending') {
                    $this->emit('toast', ['message' => '<i class="bi bi-check2-all"></i> The reply message is being reviewed by the admin before being displayed.']);
                } else {
                    $this->emit('toast', ['message' => '<i class="bi bi-check2-all"></i> A reply message has been added.']);
                }
            } else {
                $this->emit('toast', ['message' => '<i class="bi bi-check2-all"></i> A reply message has been added.']);
            }
        } catch (TooManyRequestsException $exception) {
            $this->emit('toast', ['message' => "<i class='bi bi-emoji-angry'></i> Slow down! Please wait another {$exception->secondsUntilAvailable} seconds to log in."]);
        }
    }

    public function submit()
    {
        try {
            $this->rateLimit(2);
            $this->validate([
                'comments' => 'required',
            ]);
            if (config('app.review_comment') == 1) {
                if ($this->auth_user->role == 'user') {
                    $status = 'pending';
                } else {
                    $status = 'approved';
                }
                $this->product->comments()->create([
                    'comment' => $this->comments,
                    'user_id' => $this->auth_user->id,
                    'status' => $status
                ]);
            } else {
                $this->product->comments()->create([
                    'comment' => $this->comments,
                    'user_id' => $this->auth_user->id,
                    'status' => 'approved'
                ]);
            }
            $this->comments = '';
            if (config('app.review_comment') == 1) {
                if ($status == 'pending') {
                    $this->emit('toast', ['message' => '<i class="bi bi-check2-all"></i> Comments are being reviewed by admins before being displayed.']);
                } else {
                    $this->emit('toast', ['message' => '<i class="bi bi-check2-all"></i> Comments have been added.']);
                }
            } else {
                $this->emit('toast', ['message' => '<i class="bi bi-check2-all"></i> Comments have been added.']);
            }
        } catch (TooManyRequestsException $exception) {
            $this->emit('toast', ['message' => "<i class='bi bi-emoji-angry'></i> Slow down! Please wait another {$exception->secondsUntilAvailable} seconds to log in."]);
        }
    }
}
