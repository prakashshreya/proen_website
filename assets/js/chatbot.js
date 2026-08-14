// ===============================
// PROEN AI Chatbot - Part 2
// ===============================

/*=====================================
        PROEN KNOWLEDGE BASE
=====================================*/

const knowledgeBase = {

    "who is proen": `
PROEN Consulting Services Pvt. Ltd. is a global consulting company specializing in:

• AI Enabled CLM
• Digital Transformation
• Data Engineering
• Technology Development
• Managed Services
• Staff Augmentation
• Data Extraction Services

We help organizations accelerate digital transformation through innovative technology solutions.
`,

    "about proen": `
PROEN Consulting Services Pvt. Ltd. delivers enterprise consulting services across Contract Lifecycle Management, AI, Data Engineering, and Technology Solutions.
`,

    "services": `
Our core services include:

✅ AI Enabled CLM

✅ Digital Transformation on CLM

✅ Consultation on CLM Implementation

✅ Paralegal Services

✅ Technology Development

✅ Managed Services

✅ Staff Augmentation

✅ Data Extraction as a Service
`,

    "contact": `
📧 contactus@proen.co.in

📞 +91 7483 323 205

🌐 www.proen.co.in
`,

    "contact us": `
📧 contactus@proen.co.in

📞 +91 7483 323 205
`,

    "leadership": `
You can learn more about our Leadership Team from the About Us section of our website.
`,

    "leadership team": `
PROEN's leadership team consists of experienced professionals specializing in AI, CLM, Digital Transformation, and Enterprise Consulting.
`,

    "iso": `
PROEN is an ISO Certified organization committed to quality, security, and continuous improvement.
`,

    "iso certified": `
PROEN follows internationally recognized ISO standards for delivering secure and high-quality consulting services.
`,

    "careers": `
We're always looking for talented professionals.

Visit the Careers page on our website to explore current opportunities.
`,

    "meet the team": `
Meet the passionate professionals behind PROEN who drive innovation, collaboration, and customer success.
`,

    "location": `
You can reach PROEN Consulting Services Pvt. Ltd. through our Contact page for office locations and regional presence.
`

};


/*=====================================
        LEAD DETAILS
=====================================*/

let leadData = {

    name: "",

    email: "",

    phone: "",

    organization: "",

    designation: "",

    domain: "",

    location: "",

    description: ""

};

let leadMode = false;

let currentStep = "";

/*=====================================
        SERVICE DETAILS
=====================================*/

const serviceDetails = {

    "ai enabled clm": `

AI Enabled Contract Lifecycle Management helps organizations automate:

• Contract Drafting

• Approvals

• Compliance

• Obligation Tracking

• Renewals

• AI Search

• Reporting

`,

    "digital transformation": `

Our Digital Transformation services modernize legacy contract processes into intelligent digital workflows.

`,

    "clm implementation": `

We provide complete CLM implementation including:

• Requirement Analysis

• Configuration

• Integration

• User Training

• Go Live Support

`,

    "paralegal": `

Our Paralegal Services help organizations with:

• Contract Review

• Redlining

• Legal Research

• Clause Library Management

`,

    "technology development": `

We build enterprise software, custom applications, automation platforms, APIs, and cloud-native solutions.

`,

    "managed services": `

Our Managed Services ensure continuous support, monitoring, optimization, and maintenance for enterprise applications.

`,

    "staff augmentation": `

We provide skilled professionals for short-term and long-term technology engagements.

`,

    "data extraction": `

Our Data Extraction services transform legacy documents into structured digital data using AI and OCR technologies.

`

};

function findKnowledgeAnswer(message) {

    message = message.toLowerCase();

    for (let key in knowledgeBase) {

        if (message.includes(key)) {

            return knowledgeBase[key];

        }

    }

    return null;

}

function startLeadFlow() {

    leadMode = true;

    currentStep = "name";

    console.log("Lead Mode Started");
    console.log("Current Step:", currentStep);

    appendMessage(

        "I'd be happy to connect you with our team.<br><br>Please enter your <b>Full Name</b>.",

        "bot"

    );

}

function startLeadFlow() {

    leadMode = true;

    currentStep = "name";

    appendMessage(
        "I'd be happy to connect you with our team.<br><br>Please enter your <b>Full Name</b>.",
        "bot"
    );

}


function submitLead() {

    showTyping();

    fetch("chatbot/lead.php", {

        method: "POST",

        headers: {
            "Content-Type": "application/json"
        },

        body: JSON.stringify(leadData)

    })

        .then(response => response.json())

        .then(data => {

            removeTyping();

            appendMessage(data.message, "bot");

            // Reset lead data
            leadData = {

                name: "",
                email: "",
                phone: "",
                organization: "",
                designation: "",
                domain: "",
                location: "",
                description: ""

            };

        })

        .catch(error => {

            removeTyping();

            console.error(error);

            appendMessage(

                "Sorry! Unable to submit your enquiry.",

                "bot"

            );

        });

}


function processLead(message) {

    switch (currentStep) {

        case "name":

            leadData.name = message;

            currentStep = "email";

            appendMessage(
                "Please enter your <b>Business Email</b>.",
                "bot"
            );

            break;

        case "email":

            leadData.email = message;

            currentStep = "phone";

            appendMessage(
                "Please enter your <b>Phone Number</b>.",
                "bot"
            );

            break;

        case "phone":

            leadData.phone = message;

            currentStep = "organization";

            appendMessage(
                "Please enter your <b>Organization Name</b>.",
                "bot"
            );

            break;

        case "organization":

            leadData.organization = message;

            currentStep = "designation";

            appendMessage(
                "Please enter your <b>Designation</b>.",
                "bot"
            );

            break;

        case "designation":

            leadData.designation = message;

            currentStep = "domain";

            appendMessage(
                "Which service are you interested in?",
                "bot"
            );

            break;

        case "domain":

            leadData.domain = message;

            currentStep = "location";

            appendMessage(
                "Please enter your <b>Location</b>.",
                "bot"
            );

            break;

        case "location":

            leadData.location = message;

            currentStep = "description";

            appendMessage(
                "Please describe your requirement.",
                "bot"
            );

            break;

        case "description":

            leadData.description = message;

            leadMode = false;

            currentStep = "";

            submitLead();

            break;

    }

}

function isLeadIntent(message) {

    message = message.toLowerCase();

    const keywords = [

        "implementation",

        "consultation",

        "quotation",

        "quote",

        "pricing",

        "demo",

        "contact sales",

        "talk to sales",

        "contact me",

        "staff augmentation",

        "managed services",

        "paralegal",

        "technology development",

        "ai enabled clm",

        "need clm",

        "require clm"

    ];

    return keywords.some(keyword => message.includes(keyword));

}


function findServiceAnswer(message) {

    message = message.toLowerCase();

    for (let key in serviceDetails) {

        if (message.includes(key)) {

            return serviceDetails[key];

        }

    }

    return null;

}

const chatToggle = document.getElementById("chatToggle");
const chatContainer = document.getElementById("chatContainer");
const closeChat = document.getElementById("closeChat");

const sendBtn = document.getElementById("sendBtn");
const userInput = document.getElementById("userInput");
const chatBody = document.getElementById("chatBody");

// ----------------------------
// Open Chat
// ----------------------------

chatToggle.addEventListener("click", () => {

    chatContainer.style.display = "flex";

    chatToggle.style.display = "none";

});

// ----------------------------
// Close Chat
// ----------------------------

closeChat.addEventListener("click", () => {

    chatContainer.style.display = "none";

    chatToggle.style.display = "flex";

});

// ----------------------------
// Send Button
// ----------------------------

sendBtn.addEventListener("click", sendMessage);

// ----------------------------
// Press Enter
// ----------------------------

userInput.addEventListener("keypress", function (e) {

    if (e.key === "Enter") {

        e.preventDefault();

        sendMessage();

    }

});

// ----------------------------
// Send Message
// ----------------------------

function sendMessage() {

    let message = userInput.value.trim();

    if (message === "") return;

    // -----------------------
    // Show User Message
    // -----------------------

    appendMessage(message, "user");

    userInput.value = "";

    // ==================================================
    // PHASE 2 - Continue Lead Collection
    // ==================================================

    if (leadMode) {

        processLead(message);

        return;

    }

    // ==================================================
    // PHASE 2 - Detect Sales / Lead Intent
    // ==================================================

    if (isLeadIntent(message)) {

        startLeadFlow();

        return;

    }

    // ==================================================
    // PHASE 1 - Company Knowledge
    // ==================================================

    let reply = findKnowledgeAnswer(message);

    if (reply) {

        appendMessage(reply, "bot");

        return;

    }

    // ==================================================
    // PHASE 1 - Service Knowledge
    // ==================================================

    reply = findServiceAnswer(message);

    if (reply) {

        appendMessage(reply, "bot");

        return;

    }

    // ==================================================
    // Otherwise ask Gemini
    // ==================================================

    showTyping();

    fetch("chatbot/chat.php", {

        method: "POST",

        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },

        body: "message=" + encodeURIComponent(message)

    })

        .then(response => {

            if (!response.ok) {

                throw new Error("Server Error : " + response.status);

            }
            
            return response.json();

        })

        .then(data => {

            removeTyping();

            appendMessage(data.reply, "bot");

        })

        .catch(error => {

            console.error(error);

            removeTyping();

            appendMessage(

                "Sorry! I'm unable to connect right now. Please try again later.",

                "bot"

            );

        });

}

// ----------------------------
// Add Message
// ----------------------------

function appendMessage(message, sender) {

    const div = document.createElement("div");

    div.className =
        sender === "user"
            ? "user-message"
            : "bot-message";

    div.innerHTML = message;

    chatBody.appendChild(div);

    scrollBottom();

}

// ----------------------------
// Typing
// ----------------------------

function showTyping() {

    const typing = document.createElement("div");

    typing.className = "bot-message";

    typing.id = "typing";

    typing.innerHTML = "Typing...";

    chatBody.appendChild(typing);

    scrollBottom();

}

// ----------------------------
// Remove Typing
// ----------------------------

function removeTyping() {

    const typing = document.getElementById("typing");

    if (typing) {

        typing.remove();

    }

}

// ----------------------------
// Auto Scroll
// ----------------------------

function scrollBottom() {

    chatBody.scrollTop = chatBody.scrollHeight;

}


// ===============================
// Quick Action Buttons
// ===============================

document.querySelectorAll(".quick-btn").forEach(button => {

    button.addEventListener("click", function () {

        userInput.value = this.innerText;

        sendMessage();

    });

});


/* ==========================================
   Welcome Popup
========================================== */

const welcomePopup = document.getElementById("chatWelcome");
const closeWelcome = document.getElementById("closeWelcome");
const notification = document.getElementById("chatSound");

// ------------------------------------------
// Unlock audio after first user interaction
// ------------------------------------------

let soundEnabled = false;

document.addEventListener("click", function unlockAudio() {

    notification.play()

        .then(() => {

            notification.pause();

            notification.currentTime = 0;

            soundEnabled = true;

            console.log("Audio Unlocked");

        })

        .catch(err => {

            console.log("Audio Unlock Failed:", err);

        });

    document.removeEventListener("click", unlockAudio);

}, { once: true });


// ------------------------------------------
// Show Welcome Popup after 3 seconds
// ------------------------------------------

window.addEventListener("load", function () {

    if (sessionStorage.getItem("welcomeShown")) {

        return;

    }

    setTimeout(function () {

        welcomePopup.style.display = "block";

        sessionStorage.setItem("welcomeShown", "yes");

        // Play sound only if browser already allows it

        if (soundEnabled) {

            notification.currentTime = 0;

            notification.play().catch(err => console.log(err));

        }

    }, 3000);

});


// ------------------------------------------
// Close Welcome Popup
// ------------------------------------------

closeWelcome.addEventListener("click", function () {

    welcomePopup.style.display = "none";

});


// ------------------------------------------
// Quick Action Buttons
// ------------------------------------------

document.querySelectorAll(".welcome-btn").forEach(button => {

    button.addEventListener("click", function () {

        // Play notification

        if (soundEnabled) {

            notification.currentTime = 0;

            notification.play().catch(() => { });

        }

        // Hide popup

        welcomePopup.style.display = "none";

        // Open chatbot

        chatContainer.style.display = "flex";

        chatToggle.style.display = "none";

        // Send predefined message

        const message = this.dataset.message;

        userInput.value = message;

        sendMessage();

    });

});


// ------------------------------------------
// Play sound when chatbot is opened manually
// ------------------------------------------

chatToggle.addEventListener("click", function () {

    if (soundEnabled) {

        notification.currentTime = 0;

        notification.play().catch(() => { });

    }

});