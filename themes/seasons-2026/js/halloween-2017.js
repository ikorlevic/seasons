var canv = new fabric.Canvas("halloween2017",{
    width: 420,
    height: 595
});
canv.setBackgroundImage( "http://seasons-in-garden.com/wp-content/themes/seasons-2017/images/halloween-2017-bg.png",canv.renderAll.bind(canv));

var text1 = new fabric.Text("you are invited \n to",{
    fontFamily: "Marcellus",
    fontStyle:"italic",
    fontSize:18,
    top:100,
    left: 210,
    originX:"center",
    textAlign: "center"
});

var text2 = new fabric.Textbox("Halloween Party",{
    fontFamily: "Fondamento",
    fontSize:48,
    top:190,
    left: 210,
    width: 400,
    originX:"center",
    textAlign: "center",
    fill:"#b20713"
});

var text3 = new fabric.Text("IN THE EVENING OF 31st OCTOBER \n BEGINNING AT NINETEEN O'CLOCK \n ",{
    fontFamily:"Marcellus",
    fontSize: 20,
    top: 300,
    left: 210,
    originX:"center",
    textAlign: "center"
});

var text4 = new fabric.Text("with theme",{
    fontFamily:"Marcellus",
    fontStyle:"italic",
    fontSize:18,
    top:370,
    left: 210,
    originX:"center",
    textAlign: "center"});

var text5 = new fabric.Textbox("Gothica",{
    fontFamily: "Fondamento",
    fontSize:28,
    top:400,
    left: 210,
    width: 400,
    originX:"center",
    textAlign: "center",
    fill:"#b20713"
});

var text6 = new fabric.Text("DRESS APPROPRIATELLY \n IN COLOURS BLACK, RED, PURPLE \n AND WHITE",{
    fontFamily:"Marcellus",
    fontSize: 20,
    top: 450,
    left: 210,
    originX:"center",
    textAlign: "center"
});

canv.add(text1,text2,text3,text4,text5,text6);

canv.renderAll();

$(".font").click(function(f){
    var text = canv.getActiveObject();
    text.setFontFamily($(this).text());
    canv.renderAll();
});

$(".png").click(function(f){
    console.log("click");
    canv.deactivateAll().renderAll();
    var png =canv.toDataURL('png');
    var download = document.createElement('a');
    download.href = png;
    download.download = 'halloween2017.png';
    download.click();
});

$(".pdf").click(function(f){
    console.log("click");
    canv.deactivateAll().renderAll();
    var png =canv.toDataURL('png');
    var pdf = new jsPDF();

    pdf.addImage(png, 'JPEG', 0, 0);
    pdf.save("halloween2017.pdf");
/*
    var download = document.createElement('a');
    download.href = pdf;
    download.download = 'halloween2017.pdf';
    download.click();
    */
});