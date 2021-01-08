let container_div = document.getElementById('stat_remove_last_item');

if(container_div) {
    let elements = container_div.querySelectorAll('div.content-data__value');

    if (elements.length >= 3) {
        lastElement = elements[elements.length - 1];

        lastElement.style.border = 'none';
    }
}
