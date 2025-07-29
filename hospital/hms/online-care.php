<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Online Care | Next Health Chatbot</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
    <style>
        body { background: #f4f6f9; }
        .chatbot-container {
            display: flex;
            flex-direction: column;
            height: 80vh;
            min-height: 500px;
            max-width: 480px;
            margin: 40px auto 0 auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 32px 0 rgba(79,140,255,0.10);
            overflow: hidden;
        }
        .chatbot-header {
            background: linear-gradient(90deg, #4f8cff 0%, #38c6d9 100%);
            color: #fff;
            padding: 18px 24px;
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .chatbot-header .fa-stethoscope {
            font-size: 1.6rem;
        }
        .chatbot-body {
            flex: 1;
            padding: 18px 18px 0 18px;
            background: #f8fafd;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        .chatbot-footer {
            padding: 14px 18px;
            background: #f8fafd;
            border-top: 1px solid #e3eaf1;
        }
        .chat-msg {
            max-width: 80%;
            margin-bottom: 10px;
            display: flex;
            align-items: flex-end;
        }
        .chat-msg.user {
            align-self: flex-end;
            flex-direction: row-reverse;
        }
        .chat-msg.bot {
            align-self: flex-start;
        }
        .chat-bubble {
            padding: 10px 16px;
            border-radius: 16px;
            font-size: 1rem;
            line-height: 1.5;
            box-shadow: 0 2px 8px rgba(79,140,255,0.04);
        }
        .chat-msg.user .chat-bubble {
            background: linear-gradient(90deg, #4f8cff 0%, #38c6d9 100%);
            color: #fff;
            border-bottom-right-radius: 4px;
        }
        .chat-msg.bot .chat-bubble {
            background: #f1f3f6;
            color: #222;
            border-bottom-left-radius: 4px;
        }
        .chat-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #e3f2fd;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 8px;
            font-size: 1.3rem;
        }
        .typing-indicator {
            display: inline-flex;
            padding: 8px 16px;
            background: #f1f3f6;
            border-radius: 16px;
            margin-bottom: 10px;
            align-self: flex-start;
        }
        .typing-dot {
            width: 6px;
            height: 6px;
            background-color: #888;
            border-radius: 50%;
            margin: 0 2px;
            animation: typingAnimation 1.4s infinite ease-in-out;
        }
        .typing-dot:nth-child(1) { animation-delay: 0s; }
        .typing-dot:nth-child(2) { animation-delay: 0.2s; }
        .typing-dot:nth-child(3) { animation-delay: 0.4s; }
        @keyframes typingAnimation {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-4px); }
        }
        .quick-questions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }
        .quick-question {
            background: #e3f2fd;
            border: none;
            border-radius: 16px;
            padding: 6px 12px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .quick-question:hover {
            background: #bbdefb;
        }
        @media (max-width: 600px) {
            .chatbot-container { max-width: 100vw; min-height: 100vh; border-radius: 0; }
        }
    </style>
</head>
<body>
<div id="app">
<?php include('include/sidebar.php'); ?>
    <div class="app-content">
        <?php include('include/header.php'); ?>
        <div class="main-content">
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Online Care</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li><span>User</span></li>
                            <li class="active"><span>Online Care</span></li>
                        </ol>
                    </div>
                </section>
                <div class="container-fluid container-fullw bg-white">
                    <div class="chatbot-container">
                        <div class="chatbot-header">
                            <i class="fa fa-stethoscope"></i>
                            Next Health AI Chatbot
                        </div>
                        <div class="chatbot-body" id="chatbot-body">
                            <!-- Chat messages will appear here -->
                        </div>
                        <div class="chatbot-footer">
                            <form id="chatbot-form" autocomplete="off" style="display:flex;gap:8px;">
                                <input type="text" id="chatbot-input" class="form-control" placeholder="Describe your symptoms..." autocomplete="off" style="border-radius:8px;">
                                <button class="btn btn-primary" id="chatbot-send" type="submit" style="border-radius:8px;min-width:44px;"><i class="fa fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('include/footer.php'); ?>
        <?php include('include/setting.php'); ?>
    </div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script>
// Enhanced medical knowledge base with natural language responses
const medicalConditions = [
    {
        name: "Common Cold",
        keywords: ['cold', 'sneezing', 'runny nose', 'nasal congestion', 'postnasal drip'],
        symptoms: [
            "Runny or stuffy nose",
            "Sneezing",
            "Sore throat",
            "Cough",
            "Mild headache",
            "Mild body aches"
        ],
        questions: [
            "How long have you had these symptoms?",
            "Do you have any fever?",
            "Is your throat very sore or just mildly irritated?"
        ],
        treatment: {
            selfCare: [
                "Rest and drink plenty of fluids",
                "Use saline nasal drops or sprays",
                "Gargle with warm salt water for sore throat",
                "Use a humidifier or inhale steam"
            ],
            medications: [
                "For congestion: Pseudoephedrine (30-60mg every 4-6 hours) or Phenylephrine",
                "For runny nose/sneezing: Cetirizine (10mg once daily) or Loratadine (10mg once daily)",
                "For pain/fever: Paracetamol (500mg every 4-6 hours as needed) or Ibuprofen (200-400mg every 6-8 hours)"
            ],
            warning: "See a doctor if symptoms last more than 10 days, fever is high (>101.3°F), or if you have difficulty breathing."
        },
        response: "Based on your symptoms, it sounds like you may have a common cold. I recommend rest, hydration, and over-the-counter medications to relieve symptoms. Would you like me to suggest specific medications based on your most bothersome symptoms?"
    },
    {
        name: "Influenza (Flu)",
        keywords: ['flu', 'influenza', 'high fever', 'body aches', 'chills', 'fatigue'],
        symptoms: [
            "Sudden onset of high fever (100-102°F, sometimes higher)",
            "Muscle or body aches",
            "Headache",
            "Fatigue and weakness",
            "Dry cough",
            "Sore throat",
            "Runny or stuffy nose",
            "Chills and sweats"
        ],
        questions: [
            "When did your symptoms start?",
            "How high has your fever been?",
            "Are you experiencing any nausea or vomiting?",
            "Do you have any underlying health conditions?"
        ],
        treatment: {
            selfCare: [
                "Get plenty of rest",
                "Drink clear fluids like water, broth to prevent dehydration",
                "Use a humidifier to ease breathing",
                "Apply warm compresses for sinus pressure"
            ],
            medications: [
                "Antiviral medications (if started within 48 hours): Oseltamivir (Tamiflu) or Zanamivir",
                "For fever/pain: Paracetamol or Ibuprofen",
                "For congestion: Decongestants like Pseudoephedrine",
                "For cough: Dextromethorphan-containing cough syrup"
            ],
            warning: "Seek immediate medical attention if you have difficulty breathing, persistent chest pain, sudden dizziness, or severe vomiting."
        },
        response: "Your symptoms suggest influenza (flu). The flu typically comes on suddenly with fever, body aches, and fatigue. It's important to rest and stay hydrated. Would you like guidance on managing specific symptoms?"
    },
    {
        name: "Acute Gastroenteritis",
        keywords: ['stomach flu', 'vomiting', 'nausea', 'diarrhea', 'stomachache', 'abdominal pain'],
        symptoms: [
            "Diarrhea (often watery)",
            "Nausea and vomiting",
            "Stomach cramps and pain",
            "Low-grade fever (sometimes)",
            "Headache",
            "Muscle aches"
        ],
        questions: [
            "How many episodes of vomiting/diarrhea have you had?",
            "Are you able to keep fluids down?",
            "Is there blood in your stool or vomit?",
            "Have you traveled recently?"
        ],
        treatment: {
            selfCare: [
                "Start with small sips of clear liquids (water, oral rehydration solutions)",
                "Gradually introduce bland foods (BRAT diet: bananas, rice, applesauce, toast)",
                "Avoid dairy, fatty foods, caffeine, and alcohol until recovered",
                "Get plenty of rest"
            ],
            medications: [
                "For nausea/vomiting: Ondansetron (4-8mg every 8 hours as needed)",
                "For diarrhea: Loperamide (2mg after each loose stool, max 8mg/day)",
                "For fever/pain: Paracetamol (avoid Ibuprofen if stomach is sensitive)"
            ],
            warning: "Seek medical help if you see signs of dehydration (dry mouth, dizziness, dark urine), if symptoms last more than 48 hours, or if you see blood in stool/vomit."
        },
        response: "Based on your symptoms, you may have gastroenteritis (stomach flu). The main priority is preventing dehydration. Start with small sips of clear fluids and gradually reintroduce bland foods. Would you like specific medication recommendations?"
    },
    {
        name: "Migraine",
        keywords: ['migraine', 'severe headache', 'throbbing pain', 'sensitivity to light', 'aura'],
        symptoms: [
            "Moderate to severe headache (often one-sided)",
            "Throbbing or pulsating pain",
            "Sensitivity to light, sound, or smells",
            "Nausea or vomiting",
            "Visual disturbances (aura) in some cases",
            "Pain worsens with physical activity"
        ],
        questions: [
            "Where is your headache located?",
            "How would you describe the pain (throbbing, stabbing, pressure)?",
            "Do you have any visual changes before the headache?",
            "What makes it better or worse?"
        ],
        treatment: {
            selfCare: [
                "Rest in a quiet, dark room",
                "Apply cold compress to painful area",
                "Try relaxation techniques or meditation",
                "Maintain regular sleep schedule",
                "Identify and avoid triggers (certain foods, stress, etc.)"
            ],
            medications: [
                "For acute attacks: Sumatriptan (50-100mg), Rizatriptan (5-10mg), or NSAIDs like Ibuprofen",
                "For nausea: Metoclopramide (10mg) or Prochlorperazine",
                "Preventive medications (if frequent): Propranolol, Topiramate, or Amitriptyline"
            ],
            warning: "Seek emergency care if your headache is 'the worst ever', comes on suddenly, or is accompanied by fever, stiff neck, confusion, or neurological symptoms."
        },
        response: "Your symptoms suggest a migraine. Migraines often cause throbbing pain, sensitivity to light/sound, and nausea. Would you like recommendations for acute treatment or prevention strategies?"
    },
    {
        name: "Urinary Tract Infection",
        keywords: ['uti', 'urinary', 'burning urine', 'frequent urination', 'bladder pain'],
        symptoms: [
            "Burning sensation during urination",
            "Frequent urge to urinate",
            "Passing small amounts of urine",
            "Cloudy, dark, or strong-smelling urine",
            "Pelvic pain (in women)",
            "Low-grade fever (sometimes)"
        ],
        questions: [
            "How long have you had these symptoms?",
            "Do you have any fever or back pain?",
            "Is there blood in your urine?",
            "Have you had UTIs before?"
        ],
        treatment: {
            selfCare: [
                "Drink plenty of water to flush out bacteria",
                "Avoid caffeine, alcohol, and spicy foods that can irritate bladder",
                "Use a heating pad for discomfort",
                "Urinate frequently and completely empty bladder"
            ],
            medications: [
                "Antibiotics: Nitrofurantoin (100mg twice daily for 5 days), Trimethoprim-Sulfamethoxazole (double strength twice daily for 3 days)",
                "For pain: Phenazopyridine (200mg three times daily for 2 days)",
                "Cranberry supplements may help prevent future UTIs"
            ],
            warning: "See a doctor immediately if you develop fever, chills, back pain (possible kidney infection), or if symptoms persist after treatment."
        },
        response: "Your symptoms suggest a urinary tract infection (UTI). UTIs typically require antibiotic treatment. I recommend seeing a doctor for proper diagnosis and prescription. Would you like suggestions for symptom relief while you arrange medical care?"
    },
    {
        name: "COVID-19",
        keywords: ['covid', 'coronavirus', 'loss of smell', 'loss of taste', 'shortness of breath'],
        symptoms: [
            "Fever or chills",
            "Cough (usually dry)",
            "Shortness of breath or difficulty breathing",
            "Fatigue",
            "Muscle or body aches",
            "Headache",
            "New loss of taste or smell",
            "Sore throat",
            "Congestion or runny nose",
            "Nausea or vomiting",
            "Diarrhea"
        ],
        questions: [
            "When did your symptoms start?",
            "Are you having any difficulty breathing?",
            "Have you measured your oxygen saturation?",
            "Have you been in contact with anyone diagnosed with COVID-19?"
        ],
        treatment: {
            selfCare: [
                "Isolate yourself from others",
                "Rest and stay hydrated",
                "Monitor your temperature and oxygen levels if possible",
                "Use over-the-counter medications to relieve symptoms",
                "Sleep in prone position if having breathing difficulty"
            ],
            medications: [
                "For fever/pain: Paracetamol (preferred) or Ibuprofen",
                "For cough: Dextromethorphan-containing cough syrup",
                "For nasal congestion: Pseudoephedrine or nasal saline rinses",
                "In severe cases: Antivirals like Paxlovid may be prescribed"
            ],
            warning: "Seek emergency care if you have trouble breathing, persistent chest pain or pressure, new confusion, inability to wake or stay awake, or pale/gray/blue-colored skin/lips/nail beds."
        },
        response: "Your symptoms could indicate COVID-19. I recommend isolating yourself and getting tested. Most cases can be managed at home with rest and symptom relief. Would you like specific guidance based on your most concerning symptoms?"
    }
];

// Emergency conditions that require immediate attention
const emergencyConditions = [
    {
        name: "Heart Attack",
        keywords: ['heart attack', 'chest pain', 'pressure in chest', 'jaw pain', 'left arm pain', 'shortness of breath', 'sweating', 'nausea'],
        response: "🚨 EMERGENCY: Your symptoms could indicate a heart attack. Call emergency services immediately. While waiting, chew 300mg aspirin if not allergic. Stay calm and sit or lie down. Do not drive yourself to the hospital.",
        icon: "fa-heartbeat"
    },
    {
        name: "Stroke",
        keywords: ['stroke', 'face drooping', 'arm weakness', 'speech difficulty', 'sudden confusion', 'vision problems', 'severe headache'],
        response: "🚨 EMERGENCY: Your symptoms suggest a possible stroke. Time is critical - call emergency services immediately. Note the time when symptoms first appeared as this affects treatment options.",
        icon: "fa-ambulance"
    },
    {
        name: "Severe Allergic Reaction",
        keywords: ['anaphylaxis', 'swelling face', 'swelling throat', 'difficulty breathing', 'hives', 'dizziness after exposure'],
        response: "🚨 EMERGENCY: This could be anaphylaxis, a life-threatening allergic reaction. Use an epinephrine auto-injector if available and call emergency services immediately, even if symptoms improve after epinephrine.",
        icon: "fa-allergies"
    },
    {
        name: "Suicidal Thoughts",
        keywords: ['suicide', 'kill myself', 'end my life', 'want to die', 'can\'t go on'],
        response: "You're not alone, and help is available. Please call the National Suicide Prevention Lifeline at 1-800-273-8255 or your local emergency number immediately. Your life matters, and people care about you.",
        icon: "fa-life-ring"
    }
];

// General health advice for common questions
const healthAdvice = [
    {
        keywords: ['sleep', 'insomnia', 'can\'t sleep'],
        response: "For better sleep: Maintain a regular sleep schedule, create a restful environment (cool, dark, quiet), avoid screens before bed, limit caffeine after noon, and try relaxation techniques. For short-term help, Melatonin (1-5mg) 30 minutes before bed may be useful.",
        icon: "fa-bed"
    },
    {
        keywords: ['stress', 'anxiety', 'overwhelmed'],
        response: "Managing stress is important for overall health. Try deep breathing exercises, regular physical activity, mindfulness meditation, and maintaining social connections. If persistent, consider speaking with a mental health professional. For acute anxiety, medications like Lorazepam may help but require prescription.",
        icon: "fa-smile-o"
    },
    {
        keywords: ['back pain', 'backache', 'sciatica'],
        response: "For back pain: Apply ice for first 48 hours, then heat. Maintain gentle movement as tolerated. Over-the-counter pain relievers like Ibuprofen can help. Practice good posture and consider core-strengthening exercises. See a doctor if pain radiates down legs, causes weakness/numbness, or persists beyond 2 weeks.",
        icon: "fa-wheelchair"
    },
    {
        keywords: ['weight loss', 'lose weight', 'diet'],
        response: "Healthy weight loss involves: 1) Balanced diet with portion control, 2) Regular physical activity (150+ minutes/week), 3) Adequate sleep, 4) Stress management. Aim for gradual loss (1-2 lbs/week). Consult a dietitian for personalized advice. Avoid extreme diets that promise rapid results.",
        icon: "fa-weight"
    },
    {
        keywords: ['exercise', 'workout', 'fitness'],
        response: "For general fitness: Aim for 150 minutes moderate aerobic activity or 75 minutes vigorous activity weekly, plus muscle-strengthening 2+ days/week. Start slowly if new to exercise. Choose activities you enjoy. Stay hydrated and listen to your body. Consult a doctor before starting if you have health concerns.",
        icon: "fa-heartbeat"
    }
];

// Quick questions for user to click
const quickQuestions = [
    "I have fever and cough",
    "Stomach pain and diarrhea",
    "Severe headache with nausea",
    "Burning when urinating",
    "Can't sleep at night",
    "Feeling very stressed"
];

function addMessage(message, sender = 'user', icon = null) {
    const chatBody = document.getElementById('chatbot-body');
    if (!chatBody) return;
    
    // Remove any existing typing indicators
    document.querySelectorAll('.typing-indicator').forEach(el => el.remove());
    
    const msgDiv = document.createElement('div');
    msgDiv.classList.add('chat-msg', sender);
    
    if (sender === 'user') {
        msgDiv.innerHTML = `<div class="chat-bubble">${message}</div>`;
    } else {
        msgDiv.innerHTML = `
            <div class="chat-avatar">
                <i class="fa ${icon ? icon : 'fa-stethoscope'} text-info"></i>
            </div>
            <div class="chat-bubble">${message}</div>
        `;
    }
    
    chatBody.appendChild(msgDiv);
    chatBody.scrollTop = chatBody.scrollHeight;
}

function showTypingIndicator() {
    const chatBody = document.getElementById('chatbot-body');
    const typingDiv = document.createElement('div');
    typingDiv.classList.add('typing-indicator');
    typingDiv.innerHTML = `
        <span class="typing-dot"></span>
        <span class="typing-dot"></span>
        <span class="typing-dot"></span>
    `;
    chatBody.appendChild(typingDiv);
    chatBody.scrollTop = chatBody.scrollHeight;
}

function showQuickQuestions() {
    const chatBody = document.getElementById('chatbot-body');
    const questionsDiv = document.createElement('div');
    questionsDiv.classList.add('quick-questions');
    
    quickQuestions.forEach(question => {
        const button = document.createElement('button');
        button.classList.add('quick-question');
        button.textContent = question;
        button.addEventListener('click', () => {
            document.getElementById('chatbot-input').value = question;
            document.getElementById('chatbot-form').dispatchEvent(new Event('submit'));
        });
        questionsDiv.appendChild(button);
    });
    
    chatBody.appendChild(questionsDiv);
    chatBody.scrollTop = chatBody.scrollHeight;
}

function getBotResponse(input) {
    input = input.toLowerCase();
    
    // First check for emergency conditions
    for (const condition of emergencyConditions) {
        for (const keyword of condition.keywords) {
            if (input.includes(keyword)) {
                return { 
                    response: condition.response, 
                    icon: condition.icon,
                    isEmergency: true
                };
            }
        }
    }
    
    // Then check medical conditions
    for (const condition of medicalConditions) {
        for (const keyword of condition.keywords) {
            if (input.includes(keyword)) {
                // Include follow-up questions in the response
                const followUp = condition.questions.length > 0 ? 
                    `\n\nTo help assess your condition better:\n${condition.questions.join('\n')}` : '';
                
                return { 
                    response: condition.response + followUp, 
                    icon: "fa-stethoscope",
                    condition: condition.name
                };
            }
        }
    }
    
    // Check general health advice
    for (const advice of healthAdvice) {
        for (const keyword of advice.keywords) {
            if (input.includes(keyword)) {
                return { 
                    response: advice.response, 
                    icon: advice.icon
                };
            }
        }
    }
    
    // Default response if nothing matches
    return { 
        response: "I understand you're not feeling well. Could you describe your symptoms in more detail? For example:\n- What symptoms are you experiencing?\n- How long have you had them?\n- What makes them better or worse?",
        icon: "fa-question-circle"
    };
}

document.getElementById('chatbot-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const input = document.getElementById('chatbot-input');
    const userMsg = input.value.trim();
    if (!userMsg) return;
    
    addMessage(userMsg, 'user');
    input.value = '';
    
    // Show typing indicator while processing
    showTypingIndicator();
    
    // Simulate processing delay
    setTimeout(() => {
        const botResponse = getBotResponse(userMsg);
        addMessage(botResponse.response, 'bot', botResponse.icon);
        
        // Show quick questions if it's not an emergency
        if (!botResponse.isEmergency) {
            setTimeout(() => {
                showQuickQuestions();
            }, 500);
        }
    }, 1000 + Math.random() * 2000); // Random delay between 1-3 seconds
});

// Initial welcome message with more natural language
window.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        addMessage("Hello! I'm Dr. Smith, your virtual health assistant. How can I help you today? You can describe your symptoms or ask a health question. For example:", 'bot', 'fa-user-md');
        
        setTimeout(() => {
            addMessage("- I've had fever and cough for 3 days\n- My stomach hurts and I have diarrhea\n- I can't sleep at night", 'bot', 'fa-user-md');
            
            setTimeout(() => {
                showQuickQuestions();
            }, 800);
        }, 800);
    }, 500);
});
</script>
</body>
</html>