$(document).ready(function () {
  ////////// CURRENT DATE
  var currentDate = getCurrentDate();
  $("#current-date").text(currentDate);
});

function getCurrentDate() {
  const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];

  const currentDate = new Date();
  const monthIndex = currentDate.getMonth();
  const day = currentDate.getDate();
  const year = currentDate.getFullYear();

  const formattedDate = `${months[monthIndex]} ${day}, ${year}`;
  return formattedDate;
}
