const generatePdfBtn = document.getElementById('botonpdf');
const generEnviarPdfBtn = document.getElementById('enviarCrm');


generatePdfBtn.addEventListener('click', () => {
    // Crea un nuevo documento PDF
    generarPDF(1);});

generEnviarPdfBtn.addEventListener('click', () => {
        // Crea un nuevo documento PDF
        $('#spinner').show();

     var pdfData = generarPDF(2);

     $.ajax({
        url: 'guardarAzure.php',  // Reemplaza con la URL de tu servidor y endpoint
        type: 'POST',
        data: pdfData, 
        nombre: 'resumenFinanciero',  // Puedes agregar otros parámetros aquí
        // Los datos del PDF como array de bytes
        contentType: 'application/pdf',  // Indica que estás enviando un archivo PDF
        success: function(response) {
          // Manejar la respuesta del servidor si es necesario
          console.log('Archivo PDF enviado exitosamente:', response);

          // Redirigir a otra página después de guardar el PDF
          window.location.href = 'formCrm.php';
        },
        error: function(error) {
          // Manejar errores en la solicitud AJAX
          console.error('Error al enviar el archivo PDF:', error);
        },
        complete: function() {
          // Ocultar el spinner después de completar la solicitud
          $('#spinner').hide();
        }
    });
    
    });
const generarPDF = (indicador) => {
    const pdf = new jsPDF({
        format: 'letter' // Establece el tamaño del papel a carta
    });
     
    pdf.setFontSize(18);
    pdf.setTextColor(0, 58, 112);  // Establece el color del texto para los títulos
    pdf.setFontType("bold");  // Establece el texto en negritas
    pdf.text('RESUMEN FINANCIERO', pdf.internal.pageSize.getWidth() / 2, 20, { align: 'center' });  // Título 1
    pdf.setFontSize(12);  // Establece el tamaño de fuente para el contenido
    pdf.setFontType("normal");
    // Establece el estilo para el PDF
    const styles = {
        textColor: [0, 0, 0],  // Color de texto negro
        fontSize: 12,
        cellPadding: 5,
        margin: { top: 40, bottom: 20, right: 20, right: 20 }
    };

    const comisionPorcentaje = document.getElementById('comisionPorcentaje').innerText;
    const valorDollar = document.getElementById('valorDollar').innerText;
    const wattInstalacion = document.getElementById('wattInstalacion').innerText;
    const utilidadGenearl = document.getElementById('utilidadGenearl').innerText;

    const importePesos = document.getElementById('importePesos').innerText;
    const importeUtilidadPesos = document.getElementById('importeUtilidadPesos').innerText;
    const utilidadSinIVA = document.getElementById('utilidadSinIVA').innerText;
    const ivaPesos = document.getElementById('ivaPesos').innerText;
    const ivaUtilidad = document.getElementById('ivaUtilidad').innerText;

    const totalPesos = document.getElementById('totalPesos').innerText;
    const totalUtilidad = document.getElementById('totalUtilidad').innerText;
    const comisionVendedor = document.getElementById('comisionVendedor').innerText;


    const startY = 90;

    // Contenido del PDF
    const contenidoPDF = `
        PRECIO:     DIFERENTES MONEDAS UTILIZANDO EL DÓLAR COMO BASE\n
        ${comisionPorcentaje} \n 
        ${valorDollar} \n
        ${wattInstalacion} \n
        ${utilidadGenearl} \n`; 

    // Agregar contenido al PDF con estilos y posición
    pdf.setFont(styles.font);
    pdf.setFontStyle(styles.fontStyle);
    pdf.setFontSize(styles.fontSize);
    pdf.setTextColor(...styles.textColor);

    // Dividir el contenido en líneas y agregar al PDF
    const contenidoLineas = pdf.splitTextToSize(contenidoPDF, pdf.internal.pageSize.width - styles.margin.right - styles.margin.right);
    pdf.text(contenidoLineas, styles.margin.right, styles.margin.top);

    // Configurar estilos para la tabla
    const tableStyles = {
        fillColor: [255, 255, 255], // Fondo blanco
        textColor: [0, 0, 0],  // Texto negro
        headStyles: {
                fillColor: [255, 255, 255], // Fondo blanco para el encabezado
                textColor: [0, 0, 0],  // Texto negro para el encabezado
                halign: 'right', // Centra el texto del encabezado
                margin: { top: 10, bottom: 10, right: 10, right: 10 },  // Establece los márgenes externos de la tabla
            },
            lineColor: [255, 255, 255], // Establece el color de las líneas de la tabla como transparente (blanco)


            cellPadding: 2,  // Establece el espacio dentro de las celdas
            cellWidth: 'auto',  // Ajusta el ancho de las celdas según el contenido
            halign:'right',
    };
    
    pdf.autoTable({
        head: [['', 'COSTO', 'PRECIO DE VENTA', 'UTILIDAD']],
        body: [
          ['IMPORTE', importePesos, importeUtilidadPesos, utilidadSinIVA],
          ['IVA', ivaPesos, ivaUtilidad, ''],
          ['TOTAL', totalPesos, totalUtilidad, ''],
        ],
        startY: startY,
        theme: 'grid',
        styles: tableStyles,
        columnStyles: {
            0: { halign: 'right' }, // Alinea la primera columna a la derecha
            1: { halign: 'right' }, // Alinea las demás columnas a la derecha
            2: { halign: 'right' },
            3: { halign: 'right' },
        }
    });

    pdf.setFont(styles.font);
    pdf.setFontStyle(styles.fontStyle);
    pdf.setFontSize(styles.fontSize);
    pdf.setTextColor(...styles.textColor);
    pdf.text(comisionVendedor, 30, 140);
    if(indicador === 1){
        pdf.save("resumen_financiero.pdf");
    }else if(indicador === 2){
        var pdfData = pdf.output('datauristring');
        return pdfData;
    }

};
