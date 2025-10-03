document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.getElementById('quantity');
    const modalQuantity = document.getElementById('modalQuantity');
    const hiddenQuantity = document.getElementById('hiddenQuantity');

    if(quantityInput && modalQuantity && hiddenQuantity){
        quantityInput.addEventListener('input', function() {
            let val = this.value;
            if(val < 1) val = 1;
            modalQuantity.textContent = val;
            hiddenQuantity.value = val;
        });
    }
});
