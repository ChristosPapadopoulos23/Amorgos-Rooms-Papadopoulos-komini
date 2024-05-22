let index = 0;
const images = document.querySelectorAll('.image-container img');

function showImage(index) {
  images.forEach((img, i) => {
    if (i === index) {
      img.classList.add('visible');
      img.classList.remove('invisible');
    } else {
      img.classList.remove('visible');
      img.classList.add('invisible');
    }
  });
}

function nextImage() {
  index++;
  if (index >= images.length) {
    index = 0;
  }
  showImage(index);
}

function previousImage() {
  index--;
  if (index < 0) {
    index = images.length - 1;
  }
  showImage(index);
}
