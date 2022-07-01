let SpeechRecognition = window.webkitSpeechRecognition;
let recognition = new SpeechRecognition();

// let Textbox = $('#textbox');
var instructions = $('#instructions');

let Content = '';

recognition.continuous = true;

recognition.onresult = function(event) {

    let current = event.resultIndex;

    let transcript = event.results[current][0].transcript;
    let action = localStorage.getItem('action');
    console.log(transcript + ' >> action ' + action)
    if(transcript === 'work' && action === '') {
        textToSpeechHandler('okay, you choose work, How can I help you')
        localStorage.setItem('action', 'work')
    } else if(transcript === 'discuss' && action === ''){
        textToSpeechHandler('okay, you choose discuss, What is your name')
        localStorage.setItem('action', 'discuss')
    }
    if(action !== '') {
        if(action === 'work') {
            doActions(transcript)
        } else if(action === 'discuss'){
            replyToUser(transcript)
        } else {
            textToSpeechHandler('What do you want? say, discuss, for discussion and, work, for working  ')
        }
    } else {
        textToSpeechHandler('Please select an action')
    }

    Content += transcript;
    // Textbox.val(Content);

};

doActions = function(matchWith) {
    const links = Array.from(document.querySelectorAll('li a'));
    links.forEach((link) => {
        let strToPascal = link.textContent.trim()
        if (strToPascal.length > 0 && strToPascal.toPascalCase() === matchWith.toPascalCase()) {
            console.log(strToPascal + ' >> ' + matchWith)
            link.click();
        }
    })
};

replyToUser = function(askedQuestion) {
    let systemQuestion = [];
    let matchQuestions = [];
    let matchAnswer = '';
    let matchString = 0
    let question = askedQuestion.split(" ");
    faq.forEach(qa => {
        // console.log(qa.q)
        /* let str = '/'+(askQ.split(" ")).toString().replace(/,/g, '|')+'/g';
        console.log(qa.q)
        var matches = qa.q.match( str ); */
        if(qa.q.toString().toLowerCase() === askedQuestion.toString().toLowerCase()) {
            textToSpeechHandler(qa.a);
            return true
        } else {
            systemQuestion = qa.q.split(" ")
            let counter=0;

            for (let i=0;i< question.length;i++)
            {
                for (let j=0;j<systemQuestion.length;j++)

                {
                    let reg = new RegExp("^"+question[i]+"$", "gi");

                    if (systemQuestion[j].match(reg))
                    {
                        counter +=1;
                    }
                }
            }
            if(counter >= 1)
            {
                /* matchString =	matchString < counter ? counter : matchString
                      matchQuestions.push({question:qa.q, ans:qa.a, matchLevel:counter}) */
                if(matchString < counter) {
                    matchString = counter
                    matchAnswer = qa.a
                }
            }
        }
    });

    console.log(matchString + ' > ' + matchAnswer + ' > ' + askedQuestion);
    textToSpeechHandler(matchAnswer);
};

recognition.onstart = function() {
    $('#instructions').text('Voice recognition is ON.');
};

/*recognition.onabort = function() {
    $('#instructions').text('Voice recognition is off.');
};*/

recognition.onspeechend = function() {
    $('#instructions').text('Voice recognition is off');
};

recognition.onerror = function(event) {
    if(event.error == 'no-speech') {
        $('#instructions').text('Try again.');
    }
};
startVoiceCommand = function(){
    if (Content.length) {
        Content += ' ';
    }
    recognition.start();
    localStorage.setItem('action', '')
    textToSpeechHandler('Voice command started, What do you want? say, discuss, for discussion and, work, for working  ')
    $('#stop-btn').toggle()
    $('#start-btn').toggle()
};
stopVoiceCommand = function() {
    Content = ''
    textToSpeechHandler('Voice command terminated.')
    recognition.stop()
    $('#stop-btn').toggle()
    $('#start-btn').toggle()
}

/*
Textbox.on('input', function() {
    Content = $(this).val();
});*/


/* partial functions */
String.prototype.toPascalCase = function () {
    return this.match(/[a-z]+/gi)
        .map(function (word) {
            return word.charAt(0).toUpperCase() + word.substr(1).toLowerCase()
        })
        .join(' ')
}