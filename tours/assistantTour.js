var tour = new Tour({
  steps: [
  {
    element: ".navbar-brand",
    title: "Welcome",
    content: "Welcome to the Ticket Assist guided tour!"
  },
  {
    element: ".navbar-brand",
    title: "Navbar",
    content: "This is the main navbar. Here you can find useful links and menus."
  },
  {
    element: "#megalink",
    title: "Mega Link",
    content: "This is the Mega Link! When you press the link, multiple pages will open in your browser. The pages that you want opened can be edited in your profile settings. Note: Popup blocking must be disabled for this site."
  },
  {
    element: "#passwordgen",
    title: "Password Generator",
    content: "This button will generate random passwords to be used in the process of password resets. Passwords generated here are not guaranteed to meet the minimum complexity requirement."
  },
  {
    element: "#clientInfoForm",
    title: "Client Information Form",
    content: "When you're on a phone call and need a convienent place to store user information, use this form."
  },
  {
    element: "#submitButton",
    title: "Gather Information",
    content: "To use this form, enter your information and press Gather Form Infomation."
  },
  {
    element: "#infoiFrameDiv",
    title: "Information Editor",
    content: "When you press the button, the information will be displayed in a detailed, easy to read format."
  },
  {
    element: "#infoiFrameDiv",
    title: "Send Log",
    content: "If you want to save the information, so you can remember to submit a ticket later, press the Send Log button and your information will be stored..."
  },
  {
    element: "#log-tab",
    title: "Active Logs",
    content: "...over here!",
    onShow: function(tour) { $("#log-tab").tab('show'); }
  },
  {
    element: "#log-tab",
    title: "Active Logs",
    content: "This is the Active Logs tab. All logs you have saved will be stored here and can be easily resolved when you submit a ticket. Think of it as though you're flagging an email."
  },
  {
    element: "#resetbutton",
    title: "Reset Form",
    content: "If you're done working on the Client Information Form, hit the Reset Form button to reset all the fields."
  },
  {
    element: "#ann-tab",
    title: "Announcments",
    content: "The next section is the Announcments tab. This is where you can find any need to know updates from administrators.",
    onShow: function(tour) { $("#ann-tab").tab('show'); }
  },
  {
    element: "#note-tab",
    title: "Notifications",
    content: "Here is the Notifications tab. This is where you can find changes and updates that apply to you. Hit the dismiss button to delete the notification once you're done with it.",
    onShow: function(tour) { $("#note-tab").tab('show'); }
  },
  {
    element: "#trbshoot-tab",
    title: "Troubleshooting",
    content: "This is this Troubleshooting tab. It's an expandable database of information relating to UST systems and software. If you have any questions, this may be a good place to start.",
    onShow: function(tour) { $("#trbshoot-tab").tab('show'); }
  },
  {
    element: "#genresp-tab",
    title: "Generic Responses",
    content: "If you ever want a template for a response in later tickets, the responses can be created here. The responses will be stored under your account for later use.",
    onShow: function(tour) { $("#genresp-tab").tab('show'); }
  },
  {
    element: "#service-status-tab",
    title: "Service Status",
    content: "Our next set of tabs begins with the Service Status section. Here you can find information on the functionality of UST systems and services as well as updates on outages.",
    onShow: function(tour) { $("#service-status-tab").tab('show'); }
  },
  {
    element: "#twitter-tab",
    title: "Twitter",
    content: "Here is where you can find Tweets from the official ITS Twitter account. It can be useful for keeping up to date on any changes with ITS.",
    placement: "left",
    onShow: function(tour) { $("#twitter-tab").tab('show'); }
  },
  {
    element: "#contact-tab",
    title: "Contact Info",
    content: "Our final tab is the Contact Info section. This is where you can find contact information on full time employees within ITS. If you see someone that is missing, feel free to let an admin know and they would be happy to include them.",
    placement: "left",
    onShow: function(tour) { $("#contact-tab").tab('show'); }
  }
]});

function startTour() {
  tour.init();
  tour.restart();
}
