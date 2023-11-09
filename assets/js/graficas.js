
let consumoOriginal = [];
let consumoSolar = [];
let facturaActual = [];
let facturaSolar = [];
let ahorro = [];
let consumo = [];
let factura = [];
let dato;
let minConsumo;
let maxConsumo;
let minFactura;
let maxFactura;
let meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']

for(let data of datos){
  let facturaActualRedondeado = data['facturaActual'].toFixed(2); // Redondea a dos decimales
  let facturaSolarRedondeado = data['facturaSolar'].toFixed(2); // Redondea a dos decimales
  let facturaAhorroRedondeada = data['ahorro'].toFixed(2); // Redondea a dos decimales

    consumoOriginal.push(Math.round(data['consumoOriginal']));
    consumoSolar.push(Math.round(data['consumoSolar']));
    facturaActual.push(facturaActualRedondeado);
    facturaSolar.push(facturaSolarRedondeado);
    ahorro.push(facturaAhorroRedondeada);
}

consumoOriginal.pop();
consumoSolar.pop();
facturaActual.pop();
facturaSolar.pop();
ahorro.pop();
consumo.push(Math.min.apply(null, consumoOriginal));
consumo.push(Math.min.apply(null, consumoSolar));
consumo.push(Math.max.apply(null, consumoOriginal));
consumo.push(Math.max.apply(null, consumoSolar));
minConsumo = Math.min.apply(null, consumo);
maxConsumo = Math.max.apply(null, consumo);

factura.push(Math.min.apply(null, facturaActual));
factura.push(Math.min.apply(null, facturaSolar));
factura.push(Math.min.apply(null, ahorro))
factura.push(Math.max.apply(null, facturaActual));
factura.push(Math.max.apply(null, facturaSolar));
factura.push(Math.max.apply(null, ahorro))
minFactura = Math.min.apply(null, factura);
maxFactura = Math.max.apply(null, factura);

var options1 = {
  series: [ {
    name: "Consumo Actual",
    data: consumoOriginal
  },
  {
    name: "Consumo SPV",
    data: consumoSolar
  },
],
  chart: {
  height: 350,
  type: 'line',
  zoom: {
    enabled: false
  },
},
dataLabels: {
  enabled: false
},
stroke: {
  width: [5, 7, 5],
  curve: 'straight',
  dashArray: [0, 8, 5]
},
title: {
  text: 'Comparativa Consumo Actual VS Consumo SPV',
  align: 'left'
},
legend: {
  tooltipHoverFormatter: function(val, opts) {
    return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
  }
},
markers: {
  size: 0,
  hover: {
    sizeOffset: 6
  }
},
xaxis: {
  categories: meses,
},

yaxis: {
  title: {
    text: 'Consumo'
  },
  min: minConsumo,
  max: maxConsumo
},
tooltip: {
  y: [
    {
      title: {
        formatter: function (val) {
          return val + " (Kwh)"
        }
      }
    },
    {
      title: {
        formatter: function (val) {
          return val + " (Kwh)"
        }
      }
    },
    {
      title: {
        formatter: function (val) {
          return val;
        }
      }
    }
  ]
},
grid: {
  borderColor: '#f1f1f1',
}
};

var options2 = {
  series: [ {
    name: "Factura Actual",
    data: facturaActual
  },
  {
    name: "Factura SPV",
    data: facturaSolar
  },

  {
    name: 'Ahorro',
    data: ahorro
  }
],
  chart: {
  height: 350,
  type: 'line',
  zoom: {
    enabled: false
  },
   background: '#F5F5F5' 
},
colors: ['#FF5733', '#FFC300', '#008000'],  // Lista de colores personalizados para las series
dataLabels: {
  enabled: false
},
stroke: {
  width: [5, 7, 5],
  curve: 'straight',
  dashArray: [0, 8, 5]
},
title: {
  text: 'Comparativa Factura Actual VS Factura SPV',
  align: 'left'
},
legend: {
  tooltipHoverFormatter: function(val, opts) {
    return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
  }
},
markers: {
  size: 0,
  hover: {
    sizeOffset: 6
  }
},
xaxis: {
  categories: meses,
},

yaxis: {
  title: {
    text: 'Factura $'
  },
  min: minFactura,
  max: maxFactura
},
grid: {
  borderColor: '#000000',
}
};
var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);
var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
chart1.render();
chart2.render();
const generatePdfBtn = document.getElementById('botonpdf');
// Agrega un evento de clic al botón
generatePdfBtn.addEventListener('click', () => {
  // Crea un nuevo documento PDF
  const pdf = new jsPDF({
    format: 'letter' // Establece el tamaño del papel a carta
  });

  pdf.setFontSize(18);
  pdf.setTextColor(0, 58, 112)  // Establece el tamaño de fuente para los títulos
  pdf.setFontType("bold");  // Establece el texto en negritas
  pdf.text('RESUMEN EJECUTIVO', pdf.internal.pageSize.getWidth() / 2, 20, { align: 'center' });  // Título 1
  pdf.setTextColor(0, 0, 0)  
  pdf.setFontType("normal");  // Restaura el estilo de fuente normal
  pdf.setFontSize(12);  // Establece el tamaño de fuente para el subtítulo
  pdf.text('TABLA DE NUEVOS CONSUMOS VS HISTÓRICOS', pdf.internal.pageSize.getWidth() / 2, 30, { align: 'center' });  // Título 2

  const startY = 35

  // Estilos para la tabla
  var styles = {
    cellPadding: 5,  // Establece el relleno de las celdas
    columnStyles: {
      0: { halign: 'center' },
      1: { halign: 'center' },  // Alinea la columna 'CONSUMO CON SPV Kwh' a la derecha
      2: { halign: 'center' },  // Alinea la columna 'FACTURA ACTUAL' a la derecha
      3: { halign: 'right' },  // Alinea la columna 'FACTURA CON SPV' a la derecha
      4: { halign: 'right' },  // Alinea la columna 'AHORRO' a la derecha
      5: { halign: 'right' },  // Alinea la columna 'AHORRO' a la derecha
    },

    headStyles: {
      fillColor: [0, 58, 112],  // Color de fondo del encabezado (#003a70)

      fontStyle: 'bold',  // Estilo del texto del encabezado (negrita)
      halign: 'center'  // Alinea el texto del encabezado al centro
    }
  };


  // Agrega la tabla al documento PDF
  pdf.autoTable({
    head: [['MES', 'CONSUMO ACTUAL Kwh', 'CONSUMO CON SPV Kwh', 'FACTURA ACTUAL', 'FACTURA CON SPV', 'AHORRO']],
    body: datos.map(item => [item.mes, Math.round(item.consumoOriginal), Math.round(item.consumoSolar), '$' + item.facturaActual.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'), '$' + item.facturaSolar.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'), '$' + item.ahorro.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')]),
    startY: startY,
    ...styles  // Aplica los estilos a la tabla
  });

  // Guarda el documento PDF
  var dataURL = chart1.dataURI().then(({ imgURI, blob }) => {
    pdf.addImage(imgURI, 'PNG', 10, 147, 175, 62); // Especifica el ancho y alto deseados (50x50 puntos)
  })

  var dataURL = chart2.dataURI().then(({ imgURI, blob }) => {
    pdf.addImage(imgURI, 'PNG', 10, 210,175, 62 );
    pdf.save("resumen_ejecutivo.pdf");
  })
});
