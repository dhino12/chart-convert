function crTable(idForm) {
    const createTable = document.createElement('table');
    const createThead = document.createElement('thead');
    const createTbody = document.createElement('tbody');
    const createTr = document.createElement('tr'); 
    const createTr2 = document.createElement('tr'); 

    const createTh1 = document.createElement('th');
    const createTh2 = document.createElement('th');

    const createTd1 = document.createElement('td');
    const createTd2 = document.createElement('td');

    const createInput1 = document.createElement('input');
    const createInput2 = document.createElement('input');
    const createInput3 = document.createElement('input');
    const createInput4 = document.createElement('input');

    createTr.id = 'kolom';
    createTr2.id = 'baris';
    
    createTable.className = 'table table-bordered table-striped table-hover';
    createInput1.className = 'form-control border-0';
    createInput1.placeholder = 'Masukan Data';
    createInput1.type = 'text';
     
    createInput2.className = 'form-control border-0';
    createInput2.placeholder = 'Masukan Data';
    createInput2.type = 'text';

    createInput3.className = 'form-control border-0';
    createInput3.placeholder = 'Masukan Data';
    createInput3.type = 'text';

    createInput4.className = 'form-control border-0';
    createInput4.placeholder = 'Masukan Data';
    createInput4.type = 'text';

    // head table
    createTh1.appendChild(createInput1);
    createTh2.appendChild(createInput2);

    createTr.appendChild(createTh1);
    createTr.appendChild(createTh2);

    createThead.appendChild(createTr);
    createTable.appendChild(createThead);
    idForm.appendChild(createTable);
    
    // ==========================================
    createTd1.appendChild(createInput3);
    createTd2.appendChild(createInput4);
    createTr2.appendChild(createTd1);
    createTr2.appendChild(createTd2);
    createTbody.appendChild(createTr2);
    createTable.appendChild(createTbody);
    idForm.appendChild(createTable);
}
export default { crTable }