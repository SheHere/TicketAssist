var tour = new Tour({
  steps: [
  {
    element: "#guide-header",
    title: "Guide Index",
    content: "Welcome to the Guides section of Ticket Assist! Here you can find information on various UST systems and other useful resources."
  },
  {
    element: ""
  }
]});

function startTour() {
  tour.init();
  tour.restart();
}
