{{-- resources/views/components/comment-modal.blade.php --}}
@php
    $model = $type === 'post' ? $post ?? null : $requestModel ?? null;
   // dd($model);
@endphp

@if($model)
 <div class="modal fade" id="commentModal-{{ $type }}-{{ $model->id }}" tabindex="-1" aria-labelledby="commentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">コメント一覧</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div class="modal-body">
                <div id="comment-list-{{ $type }}-{{ $model->id }}">
                    @foreach ($model->comments as $comment)
                        @include('components.single-comment', ['comment' => $comment])
                    @endforeach
                </div>


                <form method="POST" onsubmit="return submitComment(event, '{{ route('comments.store') }}', '{{ $type }}', {{ $model->id }})">
                    @csrf
                    <div class="mb-3">
                        <textarea name="body" class="form-control" rows="3" placeholder="コメントを入力..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">送信</button>
                </form>
            </div>
        </div>
    </div>
 </div>
@else
 <p class="text-muted">コメントはありません。</p>
@endif
