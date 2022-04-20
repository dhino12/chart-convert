import { crTable } from './table/createTable'

const btnCreateTable = document.querySelector('#btnCreateTable');
const formInput = document.querySelector('#form-input');

btnCreateTable.addEventListener('click', () => {

    // createTd.appendChild(createInput);
    // createTr.appendChild(createTd);
    // createTr.appendChild(createTd);

    // createTable.appendChild(createTr);
    // createTable.appendChild(createTr);

    crTable(formInput);
});