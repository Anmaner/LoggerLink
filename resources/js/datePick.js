formatDate = (date) => {
    let day = date.getDate().toString();
    let month = (date.getMonth() + 1).toString();
    let year = (date.getFullYear()).toString();

    day = day.length === 1 ? '0' + day : day;
    month = month.length === 1 ? '0' + month : month;

    return `${day}-${month}-${year}`;
};

isEmptyValueAttribute = (selector) => {
    return document.querySelector(selector).getAttribute('value') === '';
}

setDefaultFirstDate = (selector) => {
    let oneMonthAgo = new Date(
        new Date().getFullYear(),
        new Date().getMonth() - 1,
        new Date().getDate()
    );

    document.querySelector(selector).setAttribute('value', formatDate(oneMonthAgo));
}

setDefaultSecondDate = (selector) => {
    let nowDate = new Date();

    document.querySelector(selector).setAttribute('value', formatDate(nowDate));
}




let firstDateInput = 'input[name="first_date"]';
let secondDateInput = 'input[name="second_date"]';

if(document.querySelector(firstDateInput) && document.querySelector(secondDateInput)) {
    instance1 = new dtsel.DTS(firstDateInput, {
        dateFormat: "dd-mm-yyyy"
    });

    instance2 = new dtsel.DTS(secondDateInput, {
        dateFormat: "dd-mm-yyyy"
    });

    if(isEmptyValueAttribute(firstDateInput)) {
        setDefaultFirstDate(firstDateInput);
    }

    if(isEmptyValueAttribute(secondDateInput)) {
        setDefaultSecondDate(secondDateInput);
    }
}
