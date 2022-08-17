var RandomImages = [
    "images/1.png",
    "images/2.png",
    "images/3.png",
    "images/4.png",
    "images/5.png",
    "images/6.png",
    "images/7.png",
    "images/8.png",
    "images/9.png",
    "images/10.png"
];

// Generate Unique Random Numbers From Random() Function
var uniqueIndex = [];

// How Many Images/Number We Want (uniqueIndex.length < "TypeHere")
while (uniqueIndex.length < 4) {
    // Total Number For Images We Have In Image Array i.e. 9 = 8 + 1 Like this
    var r = Math.floor(Math.random() * 8) + 1;
    if (uniqueIndex.indexOf(r) === -1) uniqueIndex.push(r);
}
// Get Unique Random Numbers And Use Them To Show Images

for (var i = 0; i < uniqueIndex.length; i++) {

    random = uniqueIndex[i];

    // Create HTML Image Tag
    var img = document.createElement('img');

    // Insert The Source Of Image From (var random)
    img.src = RandomImages[random];

    // Add Classes Into Image Tag
    img.classList.add('custom-random-image')

    // Create HTML Div Tag
    var div = document.createElement('div');

    // Add Classes Into Div Tag
    div.classList.add('col-md-3', 'random-image-column');

    // Insert Image Into Div Tag
    div.appendChild(img);

    // Insert Div Into The #random_image_row Containing Tag
    document.getElementById('random_image_row').appendChild(div);

}