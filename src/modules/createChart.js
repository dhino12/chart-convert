function crCanvas (tTitle, counter) {
    const crCanvas = document.createElement('canvas')
    crCanvas.id = `myChart${counter}`;
    
    const crWrapper = document.createElement('div')
    crWrapper.className = "col-xl-6 d-flex flex-column"
    crWrapper.id = "wrapper-canvas"

    const headerCanvas = document.createElement("div");
    headerCanvas.className = "d-flex justify-content-between"
    headerCanvas.id = "header-canvas";

    const tCanvas = document.createElement("h5");
    tCanvas.className = "w-100 pt-1 text-center";
    tCanvas.innerText = tTitle;

    const iconFeature = document.createElement('div');
    iconFeature.className = "icon";

    const editBtn = document.createElement("div");
    editBtn.className = "d-flex align-center btn round-cs-6 me-2";
    editBtn.id = "btn-edit";

    const stracthBtn = document.createElement("div");
    stracthBtn.className = "d-flex align-center btn round-cs-6 me-2";
    stracthBtn.id = "btn-stratch";

    const link = document.createElement("a")
    link.style.margin = "auto"

    const imgIcon =  document.createElement("img")
    imgIcon.src = "./media/icon/edit.svg";
    imgIcon.width = 25;

    const imgIconStracth =  document.createElement("img")
    imgIconStracth.src = "./media/icon/stratch.svg";
    imgIconStracth.width = 25;
    
    link.appendChild(imgIcon);
    editBtn.appendChild(link);
    stracthBtn.appendChild(imgIconStracth);
    iconFeature.appendChild(editBtn);
    iconFeature.appendChild(stracthBtn);
    headerCanvas.appendChild(tCanvas);
    headerCanvas.appendChild(iconFeature);
    
    crWrapper.appendChild(headerCanvas);
    crWrapper.appendChild(crCanvas);

    return crWrapper;
}