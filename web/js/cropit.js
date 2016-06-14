/*
 * This file is part of the TJ-SIF 2016 project.
 *
 * (c) toconuts <toconuts@google.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

//$('#image-cropper').cropit();
$('#image-cropper').cropit({
    imageBackground: true,
//    imageState: {
//        src: 'http://localhost:8000/images/user/3/initial_user.png'
//    }
    imageBackgroundBorderWidth: 100
});

//$('#image-cropper').cropit('imageSrc', 'http://localhost:8000/images/user/3/initial_user.png');
$('#image-cropper').cropit('imageSrc', $("#current-imagefile").attr('src'));
//$('#image-cropper').cropit({ imageState: { src: { imageSrc } } });

/*$('.preview-wrapper').cropit({
    imageBackground: true
});*/

// Exporting cropped image
$('.download-btn').click(function() {
  var imageData = $('#image-cropper').cropit('export');
  window.open(imageData);
});

// When user clicks select image button,
// open select file dialog programmatically
$('.select-image-btn').click(function() {
  $('.cropit-image-input').click();
});

// Handle rotation
$('.rotate-cw-btn').click(function() {
  $('#image-cropper').cropit('rotateCW');
});
$('.rotate-ccw-btn').click(function() {
  $('#image-cropper').cropit('rotateCCW');
});

$('form').submit(function () {
    // Move cropped image data to hidden input
    var imageData = $('#image-cropper').cropit('export');
    $('.hidden-image-data').val(imageData);
});