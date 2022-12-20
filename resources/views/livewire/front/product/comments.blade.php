<div>
    <div class="comments-content">
        @foreach ($product->comments()->get() as $cm)
            <div class="comment-item">
                <img class="avatar" src="{!! $cm->user->avatar() !!}" alt="{{ $cm->user->name }}">
                <div class="card border-0 w-100">
                    <div class="card-header py-1">
                        <a class="fw-bold" href="{!! route('front.profile.index', $cm->user->username) !!}" style="text-decoration: none;font-size: 15px;">{{ $cm->user->name }} </a>
                        @if ($cm->user->id == $product->author_id)
                            <small><i class="bi bi-pencil"></i></small>
                        @endif
                        <small>{!! $cm->user->IsVerify() !!}</small>
                    </div>
                    <div class="card-body comment-body" style="background: #202c40;">
                        <p class="m-0">{{ $cm->comment }}</p>
                    </div>
                    <div class="card-footer py-1 d-flex">
                        <div class="me-auto">
                            @if ($auth_user)
                                <a href="javascript:void(0)" onclick="reply({{ $cm->id }})" class="me-2 text-muted reply-comment-btn"><i class="bi bi-reply"></i> Reply</a>
                            @else
                                <a href="{{ route('login') }}" class="me-2 text-muted reply-comment-btn"><i class="bi bi-reply"></i> Reply</a>
                            @endif
                            <small class="text-muted">{{ $cm->created_at->diffForHumans() }}</small>
                        </div>
                        @if ($auth_user)
                            @if ($cm->user_id == $auth_user->id)
                                <a href="javascript:void(0)" wire:loading.remove wire:target="destroy" onclick="deletecomment({{ $cm->id }})" class="me-3 text-muted reply-comment-btn"><i class="bi bi-trash"></i></a>
                                <a href="javascript:void(0)" wire:loading wire:target="destroy" class="me-3 text-muted reply-comment-btn">
                                    <div class="spinner-grow" style="height: 10px; width: 10px" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            @if ($auth_user)
                <div class="comment-item reply form-replys" wire:ignore class="form-replys" id="form-reply-{{ $cm->id }}" style="display: none">
                    <img class="avatar" src="{!! $auth_user->avatar() !!}" alt="{{ $auth_user->name }}">
                    <div class="comment">
                        <form wire:submit.prevent="reply">
                            <div class="card p-0">
                                <textarea wire:model="comment" placeholder="Hi {{ $auth_user->name }}! Write your reply message here..." rows="4"></textarea>
                                <div class="card-footer comment-footer text-end">
                                    <div class="me-auto">
                                        <a class="comment-tools" href="#"><i class="bi bi-link-45deg"></i></a>
                                        <a class="comment-tools" href="#"><i class="bi bi-type-bold"></i></a>
                                        <a class="comment-tools" href="#"><i class="bi bi-type-italic"></i></a>
                                    </div>
                                    <button wire:loading.remove wire:target="reply" type="submit" class="btn btn-dark btn-comment-send"><i class="bi bi-send"></i> Send</button>
                                    <button wire:loading wire:target="reply" disabled class="btn btn-dark btn-comment-send"><i class="bi bi-send"></i> Sending..</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            @foreach ($cm->child()->get() as $child)
                <div class="comment-item reply">
                    <img class="avatar" src="{!! $child->user->avatar() !!}" alt="{{ $child->user->name }}">
                    <div class="card border-0 w-100">
                        <div class="card-header py-1">
                            <a class="fw-bold" href="{!! route('front.profile.index', $child->user->username) !!}" style="text-decoration: none;font-size: 15px;">{{ $child->user->name }}</a>
                            @if ($child->user->id == $product->author_id)
                                <small><i class="bi bi-pencil"></i></small>
                            @endif
                            <small>{!! $child->user->IsVerify() !!}</small>
                            <small><i class="text-muted bi bi-reply"></i></small>
                        </div>
                        <div class="card-body comment-body" style="background: #202c40;">
                            <p class="m-0">{{ $child->comment }}</p>
                        </div>
                        <div class="card-footer py-1 d-flex">
                            <div class="me-auto">
                                <small class="text-muted">{{ $child->created_at->diffForHumans() }}</small>
                            </div>
                            @if ($auth_user)
                                @if ($child->user_id == $auth_user->id)
                                    <a href="javascript:void(0)" wire:loading.remove wire:target="destroy" onclick="deletecomment({{ $child->id }})" class="me-3 text-muted reply-comment-btn"><i class="bi bi-trash"></i></a>
                                    <a href="javascript:void(0)" wire:loading wire:target="destroy" class="me-3 text-muted reply-comment-btn">
                                        <div class="spinner-grow" style="height: 10px; width: 10px" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </a>
                                @endif
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
    @if ($auth_user)
        <div class="comment">
            <form wire:submit.prevent="submit">
                <div class="card p-0">
                    <textarea wire:model="comments" placeholder="Hi {{ $auth_user->name }}! Write your comment here..." rows="4"></textarea>
                    <div class="card-footer comment-footer text-end">
                        <div class="me-auto">
                            <a class="comment-tools" href="#"><i class="bi bi-link-45deg"></i></a>
                            <a class="comment-tools" href="#"><i class="bi bi-type-bold"></i></a>
                            <a class="comment-tools" href="#"><i class="bi bi-type-italic"></i></a>
                        </div>
                        <button wire:loading.remove wire:target="submit" type="submit" class="btn btn-dark btn-comment-send"><i class="bi bi-send"></i> Send</button>
                        <button wire:loading wire:target="submit" disabled class="btn btn-dark btn-comment-send"><i class="bi bi-send"></i> Sending...</button>
                    </div>
                </div>
            </form>
        </div>
    @else
        <div class="alert bg-dark border border-secondary text-center" role="alert">
            <i class="text-info bi bi-emoji-smile"></i> <br> Login to be able to comment.
        </div>
    @endif
</div>

@push('js')
    <script>
        function deletecomment(id) {
            @this.destroy(id)
        }

        function reply(id) {
            var element = document.getElementById('form-reply-' + id);
            var formReplys = document.getElementsByClassName('form-replys');
            for (var i = 0; i < formReplys.length; i++) {
                formReplys[i].style.display = 'none';
            }
            @this.setValue(id, '');
            if (element.style.display == 'none') {
                element.style.display = 'flex';
            } else {
                element.style.display = 'none';
            }
        }
    </script>
@endpush
