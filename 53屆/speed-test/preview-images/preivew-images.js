(() => {
    const styleString = `#preview-image {
        position: fixed;
        display: none;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 100;
    }
    
    #preview-image>.background {
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }
    
    #preview-image>.next-image, #preview-image>.prev-image {
        cursor: pointer;
        background-color: rgba(0, 0, 0, 0.7);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 30px;
        color: #fff;
        z-index: 200;
    }
    
    #preview-image>img{
        height: 80%;
        max-width: 80%;
        object-fit: contain;
        z-index: 200;
    }`
    
    const style = document.createElement('style')
    style.innerHTML = styleString
    document.head.appendChild(style)
    
    
    const images = document.querySelectorAll('img')
    const previewImage = document.createElement('div')
    previewImage.id = 'preview-image'
    previewImage.innerHTML = `
        <div class="background"></div>
        <div class="prev-image"><</div>
        <img src="" alt="">
        <div class="next-image">></div>
    `
    document.body.appendChild(previewImage)
    
    const nextImage = document.querySelector('#preview-image>.next-image')
    const prevImage = document.querySelector('#preview-image>.prev-image')
    const previewImageImg = document.querySelector('#preview-image>img')
    const previewImageBackground = document.querySelector('#preview-image>.background')
    
    let currentImage = 0
    let imagesArray = []
    
    const toDataURL = url => fetch(url)
        .then(response => response.blob())
        .then(blob => new Promise((resolve) => {
            const reader = new FileReader()
            reader.onload = (e) => resolve(e.target.result)
            reader.readAsDataURL(blob)
        }))
    
    images.forEach((image, index) => {
        toDataURL(image.src).then(dataurl => {
            imagesArray[index] = dataurl
        })
        imagesArray.push(image.src)
        
        image.addEventListener('click', () => {
            currentImage = index
            previewImageImg.src = imagesArray[index]
            previewImage.style.display = 'flex'
        })
    })
    
    nextImage.addEventListener('click', () => {
        if (currentImage < imagesArray.length - 1) {
            currentImage++
            previewImageImg.src = imagesArray[currentImage]
        } else {
            currentImage = 0
            previewImageImg.src = imagesArray[currentImage]
        }
    })
    
    prevImage.addEventListener('click', () => {
        if (currentImage > 0) {
            currentImage--
            previewImageImg.src = imagesArray[currentImage]
        } else {
            currentImage = imagesArray.length - 1
            previewImageImg.src = imagesArray[currentImage]
        }
    })
    
    previewImageBackground.addEventListener('click', () => {
        previewImage.style.display = 'none'
    })
    
    console.log('preview-images.js loaded');
})()
