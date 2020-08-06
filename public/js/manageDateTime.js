const currentDate = new Date();
const datePicker = document.getElementById("datePicker");
const timePicker = document.getElementById("timePicker");
const hidDateSelected = document.getElementById("hidden-date");
const hidTimeSelected = document.getElementById("hidden-time");
const hidEndTime = document.getElementById("hidden-end-time");

const dateSelected = document.getElementById("dateSelected");
const timeSelected = document.getElementById("timeSelected");
timeSelected.innerText = moment(currentDate).format("hh:mm");
dateSelected.innerText = moment(currentDate).format("MMMM Do YYYY");

//Fill time picker
let key = 1;
for (let index = 8; index < 19; index++) {
    let timeOption = `${index}:00`;
    let option = new Option(timeOption, key++);
    timePicker.add(option);
    timeOption = `${index}:30`;
    option = new Option(timeOption, key++);
    timePicker.add(option);
}

let localdate = "";
datePicker.addEventListener("change", (e) => {
    dateSelected.innerText = moment(e.target.value).format("MMMM Do YYYY");

    parseDates(e.target.value, hidTimeSelected.value);
});
timePicker.addEventListener("change", (e) => {
    timeSelected.innerText = e.target[e.target.value].innerText;

    parseDates(datePicker.value, e.target[e.target.value].innerText);
});

const parseDates = (date, time) => {
    localdate = `${date} ${time}`;
    let dateobj = new Date(localdate);
    let dateIso = dateobj.toISOString();
    hidDateSelected.value = dateIso;
    let endMeeting = new Date(
        moment(dateIso).add(60, "m").toDate()
    ).toISOString();
    hidEndTime.value = endMeeting;
};
