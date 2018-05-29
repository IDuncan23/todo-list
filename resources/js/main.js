//store array locally in order to maintain todo list items when you exit application
var data = (localStorage.getItem('todoList')) ? JSON.parse(localStorage.getItem('todoList')): {
	todo: [],
	completed: []
};

// remove and complete icons IMG
var removeIMG = '<img width="15" src="images/remove_icon.png">';
var completeIMG = '<img width="15" src="images/done_icon.png">';
var completeIMG2 = '<img width="15" src="images/done_icon2.png">';

renderTodoList();

//user clicked on the add button
//if any text in item field, add that text to the todo list
document.getElementById('add').addEventListener('click', function(){
	var value = document.getElementById('item').value;
	if (value){ 
		addItem(value);
	};
});

// Listen for 'Enter' button to add item
document.getElementById('item').addEventListener('keydown', function(e) {
	var value = this.value;
	if (e.code === 'Enter' && value) {
		addItem(value);
	};
});

// adds item to 'todo' array and saves locally
function addItem (value) {
		addItemToDOM(value);
		document.getElementById('item').value = '';

		data.todo.push(value);
		dataObjectUpdated();
}

// if arrays are not empty, loop through and display items
function renderTodoList() {

	if (!data.todo.length && !data.completed.length) return;

	for (var i = 0; i < data.todo.length; i++) {
		var value = data.todo[i];
		addItemToDOM(value);
	}

	for (var j = 0; j < data.completed.length; j++) {
		var value = data.completed[j];
		addItemToDOM(value, true);
	}
}

// store items locally Note: localStorage only accepts text so use stringify to convert to text
function dataObjectUpdated() {
	localStorage.setItem('todoList', JSON.stringify(data));
}

// removes item from array
function removeItem() {
	var item = this.parentNode.parentNode;
	var parent = item.parentNode;
	var id = parent.id;
	var value = item.innerText;

	if (id === 'todo') {
		data.todo.splice(data.todo.indexOf(value), 1);
	} else {
		data.completed.splice(data.completed.indexOf(value), 1);
	}

	parent.removeChild(item);
	dataObjectUpdated();
}

// adds item to completed array and deletes from todo array
function completeItem () {
	var item = this.parentNode.parentNode;
	var parent = item.parentNode;
	var id = parent.id;
	var value = item.innerText;

	if (id === 'todo') {
		data.todo.splice(data.todo.indexOf(value), 1);
		data.completed.push(value);
	} else {
		data.completed.splice(data.completed.indexOf(value), 1);
		data.todo.push(value);
	}

	// Check if the item should be added to the completed list or re-added to the todo list
	var target = (id === 'todo') ? document.getElementById('completed'):document.getElementById('todo');

	parent.removeChild(item);
	target.insertBefore(item, target.childNodes[0])
	dataObjectUpdated();
}

// adds a new item to the todo list
function addItemToDOM(text, completed) {
	var list = (completed) ? document.getElementById('completed'):document.getElementById('todo');

	var item = document.createElement('li');
	item.innerText = text;

	var buttons = document.createElement('div');
	buttons.classList.add('buttons');

	var remove = document.createElement('button');
	remove.classList.add('remove');
	remove.innerHTML = removeIMG;

	// add click even for removing item
	remove.addEventListener('click', removeItem);

	var complete = document.createElement('button');
	complete.classList.add('complete')
	complete.innerHTML = completeIMG;

	// add click even for completing items
	complete.addEventListener('click', completeItem);

	buttons.appendChild(remove);
	buttons.appendChild(complete);
	item.appendChild(buttons);

	list.insertBefore(item, list.childNodes[0]);
}