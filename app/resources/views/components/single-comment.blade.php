<div class="border p-2 mb-2 rounded">
    <strong>{{ optional($comment->user)->name ?? '退会したユーザー' }}</strong>
    {{ $comment->body }}
</div>
