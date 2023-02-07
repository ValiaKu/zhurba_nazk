/* Змінні для запису в базу  
  1. Результат 
  2. Область
 */
let countZhurba = 0;
let countBasa = 0;
let oblast = "";
let gender = "";

/* Інші глобальні змінні */
let quizContainer = document.getElementById("quiz-container");
let selectedAnswers = {};
let question;
let isZhurba = true;
let index;
let countryStyle = "";

const generateOptions = () => {
  let options = ``;
  for (let i = 0; i < question.options.length; i++) {
    let option = question.options[i];
    let selected = false;

    if (selectedAnswers[`${question.question}`] == option) {
      selected = true;
    }
    options += `<div class="each-answer">
        <input type="radio" name="answer-btn" ${
          selected ? "checked='true'" : ""
        } onclick="addAnswer()" value="${option}" id="val_${option}">
        <label for="val_${option}">${option}</label>
      </div>`;
  }
  return options;
};

const generateJumpBtns = () => {
  let btns = ``;
  for (let i = 0; i < questions.length; i++) {
    btns += `<button class="jumper-button ${
      i == index ? "active" : ""
    }" onclick="showQuestion(${i})"></button>`;
  }
  return btns;
};

const addAnswer = () => {
  let currentOptions = document.getElementsByName("answer-btn");
  for (let i = 0; i < currentOptions.length; i++) {
    let currentOption = currentOptions[i];
    if (currentOption.checked == true) {
      selectedAnswers[`${question.question}`] = currentOption.value;
    }
  }
};

const restartQuiz = () => {
  index = 0;
  selectedAnswers = {};
  showQuestion(0);
};

const submitQuiz = () => {
  let answered = Object.keys(selectedAnswers);
  message = "message";
  let ask = true;
  let attempted = 0;
  let correct = 0;
  let wrong = 0;
  let resultText = "";
  let zhurbaStyle = "zhurbaStyle";
  let basaStyle = "basaStyle";

  if (ask) {
    for (let i = 3; i < questions.length; i++) {
      let question = questions[i];
      if (selectedAnswers[`${question.question}`] != undefined) {
        attempted++;
        if (selectedAnswers[`${question.question}`] == question.answer) {
          correct++;
          countBasa = 1;
          countZhurba = 0;
        } else {
          wrong++;
          countZhurba = 1;
          countBasa = 0;
        }
      }
    }

    /* Знайти вибрану область */
    let question2 = questions[1];
    if (selectedAnswers[`${question2.question}`] != undefined) {
      oblast = selectedAnswers[`${question2.question}`];
    }
    /* Стать */
    let question3 = questions[0];
    if (selectedAnswers[`${question3.question}`] != undefined) {
      gender = selectedAnswers[`${question3.question}`];
    }

    if (wrong == 0) {
      resultText = "Пишаємось тобою, ти опора країни. Тримай стрій і надалі.";
      zhurbaStyle = "";
    } else {
      resultText =
        "Візьми себе в руки! Ти потрібен, щоб перемогти москаля. Повертайся завтра і пройди тест ще раз та докажи всім, що ти наша опора.";
      basaStyle = "";
    }
    quizContainer.innerHTML = `<div class="result-wrapper">
       <div class="action-btns ${zhurbaStyle}">
        <div class="result-text">
          ${resultText} 
          <br /><br /><br />
          <div style="font-size: 14px;">
            Журба = ${countZhurba}
            <br />База = ${countBasa}
            <br /> Область = ${oblast}
            <br /> Стать = ${gender}
          </div>
        </div>
      </div>
    </div>`;
  }
};

const showQuestion = (i) => {
  index = i;
  if (index === 1) {
    countryStyle = "two-columns";
  } else {
    countryStyle = "";
  }
  if (questions[index]) {
    question = questions[index];
    let options = generateOptions(index);
    let jumpBtns = generateJumpBtns(index);

    quizContainer.innerHTML = `
            <div class="action-btns">
              <div class="bubble bubble-left">
                Допоможи своєю “силою” нашій країні побороти окупанта
              </div>
              <div class="path-box">${jumpBtns}</div>
              <div class="bubble bubble-right">Не дай журбі та росіянам бороти нас</div>
            </div>

            <div class="options-box">
              <div class="question">
                  ${question.question}
              </div>
              <div class="answers-container ${countryStyle}">
                  ${options}
              </div>
              <div class="action-btns">
                  ${
                    index > 0
                      ? `<button class="prev" onclick="showQuestion(${
                          index - 1
                        })">Назад</button>`
                      : ""
                  }
                  ${
                    index < questions.length - 1
                      ? `<button class="next" onclick="showQuestion(${
                          index + 1
                        })">Наступна</button>`
                      : ""
                  }
                  ${
                    index === questions.length - 1
                      ? `<button class="prev-next" id="submutButton"  onclick="submitQuiz()">Відправити відповіді</button>`
                      : ""
                  }
              </div>
            </div>`;
  } else {
    alert("Invalid question");
  }
};

showQuestion(0);
