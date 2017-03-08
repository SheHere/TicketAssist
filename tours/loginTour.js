var tour = new Tour({
  steps: [
  {
    element: "#request_access",
    title: "Request Access",
    content: "Click this link to put in a request for user access"
  }
]});

function startTour() {
  tour.init();
  tour.restart();
}
