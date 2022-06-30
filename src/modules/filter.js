const mostTagsAsc = document.querySelector("#most-tags-asc");
const mostTagsDesc = document.querySelector("#most-tags-desc");
const tbodyTable = document.getElementsByTagName("tbody");
const trTable = document.getElementsByTagName("tr");
const dataTable = [];

for (let i = 1; i < trTable.length; i++) {
  const tdTable = trTable[i].getElementsByTagName("td")[1];
  const getSpan = tdTable.querySelectorAll("#tag");

  const data = {
    total: getSpan.length,
    tr: trTable[i],
  };

  dataTable.push([getSpan.length, trTable[i]]);
}

mostTagsDesc.onclick = () => {
  tbodyTable[0].innerHTML = "";

  dataTable
    .sort((a, b) => a[0] - b[0])
    .reverse()
    .forEach((element) => {
      tbodyTable[0].appendChild(element[1]);
    });
};

mostTagsAsc.onclick = () => {
  tbodyTable[0].innerHTML = "";

  dataTable
    .sort((a, b) => a[0] - b[0])
    .forEach((element) => {
      tbodyTable[0].appendChild(element[1]);
    });
};
