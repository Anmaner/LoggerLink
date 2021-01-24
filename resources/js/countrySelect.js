function updateInfoItems() {
    let anchors = document.getElementsByClassName('info__item-remove');
    for(let i = 0; i < anchors.length; i++) {
        let anchor = anchors[i];
        anchor.addEventListener('click', function(e) {
            e.currentTarget.parentElement.remove();
        });
    }
}

function addInfoItem() {
    let item = document.createElement('div');
    item.className = 'info__item';

    let country = document.createElement('input');
    country.type = 'text';
    country.className = 'country';
    country.name = 'country[]';

    let info__value = document.createElement('input');
    info__value.type = 'text';
    info__value.className = 'info__item-value info__item-input';
    info__value.name = 'value[]';

    let info__remove = document.createElement('span');
    info__remove.className = 'info__item-remove';

    let font = document.createElement('i');
    font.className = 'fa fa-times';

    info__remove.appendChild(font);

    item.appendChild(country);
    item.appendChild(info__value);
    item.appendChild(info__remove);

    let items = document.getElementById('info_items');
    items.appendChild(item);

    info__remove.addEventListener('click', function(e) {
        e.currentTarget.parentElement.remove();
    });
}

function onClickNew() {
    let newInfo = document.getElementById('new');

    newInfo.addEventListener('click', function () {
        addInfoItem();
        $(".country:last").countrySelect();
    });
}


if(document.getElementById('new')) {
    $(".country").countrySelect();

    updateInfoItems();
    onClickNew();
}
