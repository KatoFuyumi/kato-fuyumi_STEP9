document.addEventListener('DOMContentLoaded', function() {
    const likeBtn = document.getElementById('like-btn');
    if (!likeBtn) return;

    likeBtn.addEventListener('click', function() {
        const productId = this.dataset.productId;
        const heartIcon = this.querySelector('i'); // ハートの要素

        // 現在の状態をクラスで判定
        const liked = heartIcon.classList.contains('fa-solid');
        const url = liked 
            ? `/products/${productId}/unlike` 
            : `/products/${productId}/like`;

        fetch(url, {
            method: 'POST', 
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(() => {
            if (liked) {
                // いいね解除
                heartIcon.classList.remove('fa-solid');
                heartIcon.classList.add('fa-regular');
                heartIcon.style.color = 'black';
            } else {
                // いいね
                heartIcon.classList.remove('fa-regular');
                heartIcon.classList.add('fa-solid');
                heartIcon.style.color = 'red';
            }
        })
        .catch(err => console.error(err));
    });
});
