var arr1;

var arr2;

let merged = [];

function download(content, fileName, contentType) {
    var a = document.createElement("a");
    var file = new Blob([content], {type: contentType});
    a.href = URL.createObjectURL(file);
    a.download = fileName;
    a.click();
}

function xhrSuccess() { 
    this.callback.apply(this, this.arguments); 
}

function xhrError() { 
    console.error(this.statusText); 
}

function loadFile(url, callback /*, opt_arg1, opt_arg2, ... */) {
    var xhr = new XMLHttpRequest();
    xhr.callback = callback;
    xhr.arguments = Array.prototype.slice.call(arguments, 2);
    xhr.onload = xhrSuccess;
    xhr.onerror = xhrError;
    xhr.open("GET", url, true);
    xhr.send(null);
}
function saveArr1(message) {
    arr1 = JSON.parse(this.responseText)
    loadFile("https://raw.githubusercontent.com/samayo/country-json/master/src/country-by-surface-area.json", saveArr2, "New message!\n\n");
}
function saveArr2(message) {
    arr2 = JSON.parse(this.responseText)
    loadFile("https://raw.githubusercontent.com/samayo/country-json/master/src/country-by-life-expectancy.json", saveArr3, "New message!\n\n");
}
function saveArr3(message) {
    arr3 = JSON.parse(this.responseText)
    loadFile("https://raw.githubusercontent.com/samayo/country-json/master/src/country-by-elevation.json", saveArr4, "New message!\n\n");
}
function saveArr4(message) {
    arr4= JSON.parse(this.responseText)
    loadFile("https://raw.githubusercontent.com/samayo/country-json/master/src/country-by-continent.json", saveArr5, "New message!\n\n");
}
function saveArr5(message) {
    arr5= JSON.parse(this.responseText)
    loadFile("https://raw.githubusercontent.com/samayo/country-json/master/src/country-by-abbreviation.json", saveArr6, "New message!\n\n");
}
function saveArr6(message) {
    arr6= JSON.parse(this.responseText)
    loadFile("https://raw.githubusercontent.com/samayo/country-json/master/src/country-by-region-in-world.json", saveArr7, "New message!\n\n");
}
function saveArr7(message) {
    arr7 = JSON.parse(this.responseText)
    loadFile("https://raw.githubusercontent.com/samayo/country-json/master/src/country-by-iso-numeric.json", saveArr8, "New message!\n\n");
}
function saveArr8(message) {
    arr8 = JSON.parse(this.responseText)
    loadFile("https://raw.githubusercontent.com/samayo/country-json/master/src/country-by-capital-city.json", saveArr9, "New message!\n\n");
}

function saveArr9(message) {
    arr9 = JSON.parse(this.responseText)
    //console.log(arr2);

    for(let i=0; i<arr1.length; i++) {
	  merged.push({
	   ...arr1[i],
	   ...(arr2.find((itmInner) => itmInner.country === arr1[i].country)),
	   ...(arr3.find((itmInner) => itmInner.country === arr1[i].country)),
	   ...(arr4.find((itmInner) => itmInner.country === arr1[i].country)),
	   ...(arr5.find((itmInner) => itmInner.country === arr1[i].country)),
	   ...(arr6.find((itmInner) => itmInner.country === arr1[i].country)),
	   ...(arr7.find((itmInner) => itmInner.country === arr1[i].country)),
	   ...(arr8.find((itmInner) => itmInner.country === arr1[i].country)),
	   ...(arr9.find((itmInner) => itmInner.country === arr1[i].country))
		}
	  );
	}

	console.log(merged);
	download(JSON.stringify(merged), 'json.txt', 'text/plain');
}

loadFile("https://raw.githubusercontent.com/samayo/country-json/master/src/country-by-population.json", saveArr1, "New message!\n\n");