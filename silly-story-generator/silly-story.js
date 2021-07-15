const customName = document.getElementById('customname');
const randomize = document.querySelector('.randomize');
const story = document.querySelector('.story');

let storyText = 'It was 94 fahrenheit outside, so :insertx: went for a walk. When they got to :inserty:, they stared in horror for a few moments, then :insertz:. Bob saw the whole thing, but was not surprised — :insertx: weighs 300 pounds, and it was a hot day.';

let insertX = [
  'Willy the Goblin',
  'Big Daddy',
  'Father Christmas'
];

let insertY =[
  'the soup kitchen',
  'Disneyland',
  'the White House'
];

let insertZ = [
  'spontaneously combusted',
  'melted into a puddle on the sidewalk',
  'turned into a slug and crawled away'
];

randomize.addEventListener('click', result);

function randomValueFromArray(array)
{
  const random = Math.floor(Math.random()*array.length);
  return array[random];
}

function result() 
{
  let newStory = storyText;
  console.log(newStory);
  
  let xItem = randomValueFromArray(insertX);
  let yItem = randomValueFromArray(insertY);
  let zItem = randomValueFromArray(insertZ);

  console.log(xItem+'-'+yItem+'-'+zItem);

  newStory = newStory.replace(/:insertx:/g, xItem);
  newStory = newStory.replace(/:inserty:/g, yItem);
  newStory = newStory.replace(/:insertz:/g, zItem);


  if(customName.value !== '') 
  {
    let name = customName.value;
    newStory = newStory.replace(/Bob/g, name);
    console.log(newStory);
  }

  if(document.getElementById("uk").checked) 
  {
    let weight = Math.round(300/14) + ' stone';
    let temperature =  Math.round(5/9*(94-32)) + ' centigrade';
    newStory = newStory.replace('300 pounds', weight);
    newStory = newStory.replace('94 fahrenheit', temperature);
  }

  story.textContent = newStory;
  story.style.visibility = 'visible';
}