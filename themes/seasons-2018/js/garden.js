/**
 * Created by webbite on 5/26/2016.
 */


    var canvas = new fabric.Canvas('garden',{backgroundColor:'#ffffff'});
    var w = $('#garden').parents('article').width();

    canvas.setWidth(w);
    canvas.setHeight(w/3);



function drawleftr(lmax){
    var path='';
    var l = 10;
    var start = 5;
    for(var i = 0;i<=canvas.getHeight(); i++){

        if(i%6==0){
            path += "M0,"+start+" L0,"+start+" L"+canvas.width+","+ start+" z ";
        }else{
            path += "M0,"+start+" L0,"+start+" L"+canvas.width+","+ start+" z ";
        }
        start+=l;
    }

    return path;
}

function drawbtmr(bmax){
    var path='';
    var l = 10;
    var start = 5;
    var h = canvas.getHeight();
    //path = "M"+start+","+h+" L"+start+","+h+" L"+ start+","+(h-10)+" z ";
    for(var i = 0;i<=canvas.getWidth(); i++){

        if(i%6==0){
            path += "M"+start+","+h+" L"+start+","+h+" L"+ start+",0 z ";
        }else {
            path += "M" + start + "," + h + " L" + start + "," + h + " L" + start + ",0 z ";
        }
        start+=l;
    }

    return path;
}

var leftr = new fabric.Path(drawleftr(0));
leftr.set({
    lockRotation:true,
    selectable:false,
    hasBorders: false,
    hasControls: false,
    hasRotatingPoint: false,
    name:'leftr',
    stroke:"#dddddd",

});

var btmr = new fabric.Path(drawbtmr(0));
btmr.set({
    lockRotation:true,
    selectable:false,
    hasBorders: false,
    hasControls: false,
    hasRotatingPoint: false,
    name:'leftr',
    stroke:"#dddddd",

});

canvas.add(leftr);
canvas.add(btmr);

// var text = new fabric.Text('my garden tool');
// canvas.add(text);

$('.objects li').click(function(e){

    var img = $(this).find('img');
    var imgInstance = new fabric.Image(img[0], {
        left: 100,
        top: 100,
        borderColor: "#9c6001",
        cornerColor: "#9c6001",
        borderDashArray: [5,5]
    });
    canvas.add(imgInstance);
    canvas.setActiveObject(imgInstance);
});

var started = false;
var del = false;
var x=0,y=0;
var surface = false;

$('.surface').click(function(e){
    surface = true;
});

$('.delete').click(function(e){
    // e.stopPropagation();
    e.preventDefault();
    del = true;

    var active = canvas.getActiveObject();

    if(active== undefined){
        active = canvas.getActiveGroup();
    }
    canvas.remove(active);

    canvas.renderAll();
});


$('.type').click(function(e){
   var val = $(this).val();

    $('.objects ul').fadeOut();
    $('.background ul').fadeOut();
    $('.background ul.color').fadeIn();
    $('#'+val).fadeIn();


    var season = $("#season").val();

    if(season==undefined){
        season="spring";
    }

    var items = $('.objects ul li');

    items.each(function(e,i){
        if(!$(this).hasClass("excpt-"+season) && $(this).hasClass(season+"-time")){
            $(this).fadeIn();
        }

        if(!$(this).hasClass(season+"-time")){
            $(this).fadeOut();
        }


    });
});

$("#season").change(function(){
    var season=$(this).val();
    var items = $('.objects ul li');

    items.each(function(e,i){
        if(!$(this).hasClass("excpt-"+season) && $(this).hasClass(season+"-time")){
            $(this).fadeIn();
        }

        if(!$(this).hasClass(season+"-time")){
            $(this).fadeOut();
        }


    });
});

$('.surface').click(function(e){

    var type = $(this).attr('id');
    var obj;

    switch(type){
        case "rect":
            obj = new fabric.Rect({
                width: 25,
                height: 25,
                x: 200,
                y: 200,
                stroke: null,
                fill: "#000000",
                borderColor: "#9c6001",
                cornerColor: "#9c6001",
                borderDashArray: [5,5]
            });
            break;
        case "circle":
            obj = new fabric.Circle({
                width: 25,
                height: 25,
                radius: 25,
                x: 200,
                y: 200,
                stroke: null,
                fill: "#000000",
                borderColor: "#9c6001",
                cornerColor: "#9c6001",
                borderDashArray: [5,5]
            });
            break;
    }

    canvas.add(obj);
});

/** containers  */
$('.container').click(function(e){
    e.stopPropagation();
    e.preventDefault();

    var type = $(this).attr("id");

    var obj;

    switch(type){
        case "rect":
            obj = new fabric.Rect({
                width: 25,
                height: 25,
                x: 200,
                y: 200,
                borderColor: "#9c6001",
                cornerColor: "#9c6001",
                stroke: "#000000",
                strokeWidth: 3,
                fill:"#9c6001",
                borderDashArray: [5,5]
            });
            break;
        case "circle":
            obj = new fabric.Circle({
                width: 25,
                height: 25,
                radius: 25,
                x: 200,
                y: 200,
                stroke: "#000000",
                strokeWidth:3,
                fill:"#9c6001",
                borderColor: "#9c6001",
                cornerColor: "#9c6001",
                borderDashArray: [5,5]
            });
            break;
        case "rect-water":
            obj = new fabric.Circle({
                width: 25,
                height: 25,
                radius: 25,
                x: 200,
                y: 200,
                stroke: "#000000",
                strokeWidth:3,
                fill:"#0066ff",
                borderColor: "#9c6001",
                cornerColor: "#9c6001",
                borderDashArray: [5,5]
            });
            break;
        case "circle-water":
            obj = new fabric.Circle({
                width: 25,
                height: 25,
                radius: 25,
                x: 200,
                y: 200,
                stroke: "#000000",
                strokeWidth:3,
                fill:"#0066ff",
                borderColor: "#9c6001",
                cornerColor: "#9c6001",
                borderDashArray: [5,5]
            });
            break;
    }

    canvas.add(obj);


});



$('.color li').click(function(e){
    var active = canvas.getActiveObject();

    var color = '#'+$(this).find('span').attr('id');

    // console.log(color);
    if(active!=undefined){
        if(active.get('stroke')){
            active.set('stroke',color);
        }else{
            active.set('fill',color);
        }
        canvas.renderAll();
    }
});

$('.move-up').click(function(e){
    e.stopPropagation();
    e.preventDefault();

    canvas.getActiveObject().bringForward();
});

$('.move-down').click(function(e){
    e.stopPropagation();
    e.preventDefault();

    canvas.getActiveObject().sendBackwards();
});

$('.export').click(function(e){
    e.stopPropagation();
    e.preventDefault();

    canvas.deactivateAll().renderAll();
    var png =canvas.toDataURL('png');
    var download = document.createElement('a');
    download.href = png;
    download.download = 'garden.png';
    download.click();

});