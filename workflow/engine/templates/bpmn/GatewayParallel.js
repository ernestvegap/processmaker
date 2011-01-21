bpmnGatewayParallel=function(width,_30ab){
VectorFigure.call(this);
this.setDimension(40,40);
};
bpmnGatewayParallel.prototype=new VectorFigure;
bpmnGatewayParallel.prototype.type="bpmnGatewayParallel";
bpmnGatewayParallel.prototype.paint=function(){
VectorFigure.prototype.paint.call(this);
var x=new Array(0,this.width/2,this.width,this.width/2);
var y=new Array(this.height/2,this.height,this.height/2,0);

var x2 = new Array();
var y2 = new Array();

for(var i=0;i<x.length;i++){
x2[i]=x[i]+4;
y2[i]=y[i]+1;
}
this.graphics.setStroke(this.stroke);
this.graphics.setColor( "#c0c0c0" );
this.graphics.fillPolygon(x2,y2);
this.graphics.setStroke(2);
this.graphics.setColor( "#fdf3e0" );
this.graphics.fillPolygon(x,y);
this.graphics.setColor("#a27628");
this.graphics.drawPolygon(x,y);
//var x=new Array(25,35,35,45,45,35,35,25,25,15,15,25);
//var y=new Array(45,45,35,35,25,25,15,15,25,25,35,35);
var x=new Array(this.width/2.4  ,  this.width/1.7,    this.width/1.7,    this.width/1.3,  this.width/1.3,   this.width/1.7,   this.width/1.7,     this.width/2.4,    this.width/2.4,   this.width/4,  this.width/4,  this.width/2.4);
var y=new Array(this.height/1.3,this.height/1.3,this.height/1.7,this.height/1.7,this.height/2.4,this.height/2.4,this.height/4,this.height/4,this.height/2.4,this.height/2.4,this.height/1.7,this.height/1.7);
this.graphics.setColor( "#a27628" );
this.graphics.fillPolygon(x,y);
this.graphics.setColor("#a27628");
this.graphics.drawPolygon(x,y);
this.graphics.paint();
};

bpmnGatewayParallel.prototype.setWorkflow=function(_40c5){
VectorFigure.prototype.setWorkflow.call(this,_40c5);
if(_40c5!=null){
    var gatewayPortName = ['input1','input2','output1','output2'];
    var gatewayPortType = ['InputPort','InputPort','OutputPort','OutputPort'];
    var gatewayPositionX= [0,this.width/2,this.height/2,this.width];
    var gatewayPositionY= [this.height/2,0,this.width,this.height/2];

    for(var i=0; i< gatewayPortName.length ; i++){
        eval('this.'+gatewayPortName[i]+' = new '+gatewayPortType[i]+'()');                               //Create New Port
        eval('this.'+gatewayPortName[i]+'.setWorkflow(_40c5)');                                        //Add port to the workflow
        eval('this.'+gatewayPortName[i]+'.setName("'+gatewayPortName[i]+'")');                            //Set PortName
        eval('this.'+gatewayPortName[i]+'.setZOrder(-1)');                                             //Set Z-Order of the port to -1. It will be below all the figure
        eval('this.'+gatewayPortName[i]+'.setBackgroundColor(new Color(255, 255, 255))');              //Setting Background of the port to white
        eval('this.'+gatewayPortName[i]+'.setColor(new Color(255, 255, 255))');                        //Setting Border of the port to white
        eval('this.addPort(this.'+gatewayPortName[i]+','+gatewayPositionX[i]+', '+gatewayPositionY[i]+')');  //Setting Position of the port
     }
}
};



bpmnGatewayParallel.prototype.getContextMenu=function(){
if(this.id != null){
  this.workflow.handleContextMenu(this);
}
};


