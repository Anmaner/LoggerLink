formatDate = (date) => {
    let day = date.getDate().toString();
    let month = (date.getMonth() + 1).toString();
    let year = (date.getFullYear()).toString();

    day = day.length === 1 ? '0' + day : day;
    month = month.length === 1 ? '0' + month : month;

    return `${day}-${month}-${year}`;
};

setDefaultDate = (firstDateInput, secondDateInput) => {
    let nowDate = new Date();
    let oneMonthAgo = new Date(
        new Date().getFullYear(),
        new Date().getMonth() - 1,
        new Date().getDate()
    );

    document.querySelector(firstDateInput).setAttribute('value', formatDate(oneMonthAgo));
    document.querySelector(secondDateInput).setAttribute('value', formatDate(nowDate));
}


let firstDateInput = 'input[name="FirstDatePicker"]';
let secondDateInput = 'input[name="SecondDatePicker"]';

if(document.querySelector(firstDateInput) && document.querySelector(secondDateInput)) {
    instance1 = new dtsel.DTS(firstDateInput, {
        dateFormat: "dd-mm-yyyy"
    });
    instance2 = new dtsel.DTS(secondDateInput, {
        dateFormat: "dd-mm-yyyy"
    });

    setDefaultDate(firstDateInput, secondDateInput);
}



