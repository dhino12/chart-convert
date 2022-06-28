function crCanvas (tTitle, counter) {
    const crCanvas = document.createElement('canvas')
    crCanvas.id = `myChart${counter}`;
    
    const crWrapper = document.createElement('div')
    crWrapper.className = "col-xl-6 d-flex flex-column"
    crWrapper.id = "wrapper-canvas"

    const headerCanvas = document.createElement("div");
    headerCanvas.className = "d-flex justify-content-between"
    headerCanvas.id = "header-canvas";

    const linkToDetail = document.createElement('a');
    linkToDetail.href = `detail.php?title=${tTitle}`;
    linkToDetail.className = "w-100 text-decoration-none"

    const tCanvas = document.createElement("h5");
    tCanvas.className = "w-100 pt-1 text-center";
    tCanvas.innerText = tTitle.split('@')[0];
    tCanvas.id = tTitle.split('@')[0];

    const iconFeature = document.createElement('div');
    iconFeature.className = "icon";

    const linkUpdate = document.createElement('a');
    linkUpdate.href = `update.php?tableName=${tTitle}`;

    const linkDelete = document.createElement('a');
    linkDelete.href = `delete.php?tableName=${tTitle}`;
    linkDelete.onclick = () => confirm(`Yakin Hapus Data ${tTitle}?`);

    const editBtn = document.createElement("div");
    editBtn.className = "d-flex align-center btn round-cs-6 me-2";
    editBtn.id = "btn-edit";

    const stracthBtn = document.createElement("div");
    stracthBtn.className = "d-flex align-center btn round-cs-6 me-2";
    stracthBtn.id = "btn-stratch";

    const deleteBtn = document.createElement("div");
    deleteBtn.className = "d-flex align-center btn round-cs-6 me-2";
    deleteBtn.id = "btn-delete";

    const link = document.createElement("a")
    link.style.margin = "auto"

    const imgIcon =  document.createElement("img")
    imgIcon.src = "./media/icon/edit.svg";
    imgIcon.width = 25;

    const imgIconStracth =  document.createElement("img")
    imgIconStracth.src = "./media/icon/stratch.svg";
    imgIconStracth.width = 25;

    const imgIconDelete =  document.createElement("div")
    imgIconDelete.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
    </svg>`;
    
    link.appendChild(imgIcon);
    editBtn.appendChild(link);
    deleteBtn.appendChild(imgIconDelete);
    stracthBtn.appendChild(imgIconStracth);
    linkUpdate.appendChild(editBtn);
    linkDelete.appendChild(deleteBtn);
    iconFeature.appendChild(linkDelete);
    iconFeature.appendChild(linkUpdate);
    iconFeature.appendChild(stracthBtn);
    linkToDetail.appendChild(tCanvas);
    headerCanvas.appendChild(linkToDetail);
    headerCanvas.appendChild(iconFeature);
    
    crWrapper.appendChild(headerCanvas);
    crWrapper.appendChild(crCanvas);

    return crWrapper;
}