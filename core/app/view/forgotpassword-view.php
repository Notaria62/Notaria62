<?php

if (Session::getUID() != "") {
    Core::redir("./?view=home", false);
} ?>
<div id="progress"></div>
<a href="/" id="login"><i class="material-icons">assignment_ind</i>
    Iniciar sesion</a>
<div class="center">
    <div id="register">

        <div id="notify" class="alert alert-danger alert-with-icon" data-notify="container" style="display:none">
            <i class="material-icons" data-notify="icon">notifications</i>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i
                    class="material-icons">close</i></button>
            <span data-notify="icon" class="now-ui-icons ui-1_bell-53"></span>
            <span data-notify="message" id="error">
            </span>
        </div>
        <div class="bmd-form-group" style="margin-top: 10px;">
            <div class="input-group justify-content-center">
                <img src="themes/notaria62web/img/logo.png" alt="Notaria 62" height="40" width="40" />
            </div>

        </div>

        <i id="previousButton" class="material-icons">arrow_back</i>

        <i id="forwardButton" class="material-icons">arrow_right</i>

        <div id="inputContainer" class="form-group">

            <label id="inputLabel" class="bmd-label-floating"></label>
            <input id="inputField" required multiple class="form-control">

            <div id="inputProgress"></div>
        </div>

    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    /**********

      This Pen uses no libraries except fonts and should 
      work on all modern browsers
      
      The answers are stored in the `questions` array
      with the key `answer`. 
      
      inspired by XavierCoulombeM
      https://dribbble.com/shots/2510592-Simple-register-form
      
     **********/

    var questions = [{
            question: "Cédula de ciudadanía"
        },
        {
            question: "Correo electrónico",
            pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/
        },
        {
            question: "Nueva contraseña",
            type: "password"
        }
    ]

    /*
      do something after the questions have been answered
    */
    var onComplete = function() {

        var h1 = document.createElement('div')
        div.appendChild(document.createTextNode(
            '<a href="/" id="login"><i class="material-icons">assignment_ind</i>Iniciar sesion < /a>'
        ));
        setTimeout(function() {
            register.parentElement.appendChild(div)
            setTimeout(function() {
                div.style.opacity = 1
            }, 50)
        }, 1000);


    }

    ;
    (function(questions, onComplete) {

        var tTime = 100 // transition transform time from #register in ms
        var wTime = 200 // transition width time from #register in ms
        var eTime = 1000 // transition width time from inputLabel in ms

        // init
        // --------------
        if (questions.length == 0) return

        var position = 0

        putQuestion()

        forwardButton.addEventListener('click', validate)
        inputField.addEventListener('keyup', function(e) {
            transform(0, 0) // ie hack to redraw
            if (e.keyCode == 13) validate()
        })

        previousButton.addEventListener('click', function(e) {
            if (position === 0) return
            position -= 1
            hideCurrent(putQuestion)
        })


        // functions
        // --------------

        // load the next question
        function putQuestion() {
            inputLabel.innerHTML = questions[position].question
            inputField.type = questions[position].type || 'text'
            inputField.value = questions[position].answer || ''
            inputField.focus()
            // set the progress of the background
            progress.style.width = position * 100 / questions.length + '%'
            previousButton.className = position ? 'material-icons' : 'material-icons'
            showCurrent()

        }

        // when submitting the current question
        function validate() {
            var validateCore = function() {
                return inputField.value.match(questions[position].pattern || /.+/)
            }
            if (!questions[position].validate) {
                questions[position].validate = validateCore
            }

            // check if the pattern matches
            if (!questions[position].validate()) {
                alert("nose");
                wrong(inputField.focus.bind(inputField))
            } else ok(function() {
                // execute the custom end function or the default value set
                if (questions[position].done) {
                    questions[position].done()
                } else {
                    questions[position].answer = inputField.value;
                }

                ++position

                // if there is a new question, hide current and load next
                if (questions[position]) {
                    $("#error").html("");
                    $("#notify").hide();
                    if (position == 1 && questions[0].answer != "") {
                        var inputF = questions[0].answer;
                        $.post("./?action=searchforgotpassword", {
                            value1: inputF,
                            value2: "",
                            value3: "",
                            getBy: "cc"
                        }, function(flag) {
                            if (flag == "ok") {
                                hideCurrent(putQuestion);
                            } else {
                                $("#error").html("Cédula de ciudadanía no existe.");
                                $("#notify").show();
                                $("#previousButton").click();
                            }

                        });
                    }

                    if (position == 2 && questions[0].answer != "" && questions[1].answer != "") {
                        var inputF1 = questions[0].answer;
                        var inputF2 = questions[1].answer;
                        $.post("./?action=searchforgotpassword", {
                            value1: inputF1,
                            value2: inputF2,
                            value3: "",
                            getBy: "email"
                        }, function(flag) {
                            if (flag == "ok") {
                                hideCurrent(putQuestion);
                            } else {
                                $("#error").html("Correo electrónico no existe.");
                                $("#notify").show();
                                $("#previousButton").click();
                            }

                        });
                    }
                } else hideCurrent(function() {
                    alert("nect3");
                    if (position == 3 && questions[0].answer != "" && questions[1].answer !=
                        "" &&
                        questions[2].answer != "") {
                        var inputF1 = questions[0].answer;
                        var inputF2 = questions[1].answer;
                        var inputF3 = questions[2].answer;
                        // alert("Value cc: " + questions[0].answer);
                        $.post("./?action=searchforgotpassword", {
                            value1: inputF1,
                            value2: inputF2,
                            value3: inputF3,
                            getBy: "password"
                        }, function(flag) {
                            if (flag == "ok") {

                            } else {
                                $("#previousButton").click();
                            }

                        });
                    }
                    // remove the box if there is no next question
                    register.className = 'close'
                    progress.style.width = '100%'

                    onComplete()

                })

            })

        }


        // helper
        // --------------

        function hideCurrent(callback) {
            inputContainer.style.opacity = 0
            inputLabel.style.marginLeft = 0
            inputProgress.style.width = 0
            inputProgress.style.transition = 'none'
            inputContainer.style.border = null
            setTimeout(callback, wTime)
        }

        function showCurrent(callback) {
            inputContainer.style.opacity = 1
            inputProgress.style.transition = ''
            inputProgress.style.width = '100%'
            setTimeout(callback, wTime)
        }

        function transform(x, y) {
            register.style.transform = 'translate(' + x + 'px ,  ' + y + 'px)'
        }

        function ok(callback) {
            register.className = ''
            setTimeout(transform, tTime * 0, 0, 10)
            setTimeout(transform, tTime * 1, 0, 0)
            setTimeout(callback, tTime * 2)
        }

        function wrong(callback) {
            register.className = 'wrong'
            for (var i = 0; i < 6; i++) // shaking motion
                setTimeout(transform, tTime * i, (i % 2 * 2 - 1) * 20, 0)
            setTimeout(transform, tTime * 6, 0, 0)
            setTimeout(callback, tTime * 7)
        }

    }(questions, onComplete))
});
</script>
<style>
body {
    margin: 0;
    background: #4042AD;
    font-family: 'Noto Sans', sans-serif;
    overflow-x: hidden;
}

h1 {
    position: relative;
    color: #fff;
    opacity: 0;
    transition: .8s ease-in-out;
}

#progress {
    position: absolute;
    background: #32338d;
    height: 100vh;
    width: 0;
    transition: width 0.2s ease-in-out;
}

.center {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}


#register {
    background: #fff;
    position: relative;
    width: 550px;
    box-shadow: 0 16px 24px 2px rgba(0, 0, 0, 0.14), 0 6px 30px 5px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.3);
    transition: transform .1s ease-in-out;
    border-radius: 10px;
}

#register.close {
    width: 0;
    padding: 0;
    overflow: hidden;
    transition: .8s ease-in-out;
    box-shadow: 0 16px 24px 2px rgba(0, 0, 0, 0);
}

#forwardButton {
    position: absolute;
    right: 20px;
    bottom: 5px;
    font-size: 40px;
    color: #fbc02d;
    float: right;
    cursor: pointer;
    z-index: 20
}

#previousButton {
    position: absolute;
    font-size: 18px;
    left: 30px;
    /* same as padding on container */
    top: 12px;
    z-index: 20;
    color: #9e9e9e;
    float: right;
    cursor: pointer;
}

#previousButton:hover {
    color: #c49000
}

#forwardButton:hover {
    color: #c49000
}

.wrong #forwardButton {
    color: #ff2d26
}

.close #forwardButton,
.close #previousButton {
    color: #fff
}

#inputContainer {
    position: relative;
    padding: 0px 20px 20px 0px;
    margin: 10px 60px 10px 10px;
    opacity: 0;
    transition: opacity .3s ease-in-out;
}

#inputContainer input {
    position: relative;
    width: 100%;
    border: none;
    font-size: 20px;
    font-weight: bold;
    outline: 0;
    background: transparent;
    box-shadow: none;
    font-family: 'Noto Sans', sans-serif;
}

/* #inputLabel {
    position: absolute;
    pointer-events: none;
    top: 32px;
    /* same as container padding + margin *
left: 20px;
/* same as container padding *
font-size: 20px;
font-weight: bold;
transition: .2s ease-in-out;
}

*/
#inputContainer input:valid+#inputLabel {
    top: 6px;
    left: 42px;
    /* space for previous arrow */
    margin-left: 0 !important;
    font-size: 11px;
    font-weight: normal;
    color: #9e9e9e;
}

#inputProgress {
    border-bottom: 3px solid #fbc02d;
    width: 0;
    transition: width .6s ease-in-out;
}

.wrong #inputProgress {
    border-color: #ff2d26;
}

@media (max-width: 420px) {
    #forwardButton {
        right: 10px
    }

    #previousButton {
        left: 10px
    }

    #inputLabel {
        left: 0
    }

    #inputContainer {
        padding-left: 0;
        margin-right: 20px
    }
}
</style>