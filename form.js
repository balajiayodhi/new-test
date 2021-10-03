function generatePDF(){
    const element = document.getElementById("invoice");
    html2pdf()
    .form(element)
    .save
}