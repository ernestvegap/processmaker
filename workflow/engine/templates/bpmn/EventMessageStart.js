bpmnEventMessageStart=function(){
VectorFigure.call(this);
this.setDimension(30,30);
this.stroke = 3;
};
bpmnEventMessageStart.prototype=new VectorFigure;
bpmnEventMessageStart.prototype.type="bpmnEventMessageStart";
bpmnEventMessageStart.prototype.paint=function(){
VectorFigure.prototype.paint.call(this);
if (this.getWidth() < 30 || this.getHeight() < 30) {
        this.setDimension(30, 30);
 }
var x_cir = 0;
var y_cir = 0;

this.graphics.setColor("#c0c0c0");
this.graphics.fillEllipse(x_cir+5,y_cir+5,this.getWidth(),this.getHeight());

this.graphics.setStroke(this.stroke);
this.graphics.setColor( "#e4f7df");
this.graphics.fillEllipse(x_cir,y_cir,this.getWidth(),this.getHeight());
this.graphics.setColor("#4aa533");
this.graphics.drawEllipse(x_cir,y_cir,this.getWidth(),this.getHeight());
this.graphics.setStroke(0);
//var x=new Array(12,12,35,35,23.5,12);
//var y=new Array(16,33,33,17,26,17);
var x=new Array(this.getWidth()/3.75,this.getWidth()/3.75,this.getWidth()/1.28,this.getWidth()/1.28,this.getWidth()/1.91,this.getWidth()/3.75);
var y=new Array(this.getHeight()/2.64,this.getHeight()/1.36,this.getHeight()/1.36,this.getHeight()/2.8,this.getHeight()/1.7,this.getHeight()/2.8);
this.graphics.setColor( "#4aa533" );
//this.graphics.fillPolygon(x,y);
this.graphics.setColor("#4aa533");
this.graphics.drawPolygon(x,y);
//var x_tri=new Array(12,23.5,35);
//var y_tri=new Array(13,22,13);
var x_tri=new Array(this.getWidth()/3.75,this.getWidth()/1.91,this.getWidth()/1.28);
var y_tri=new Array(this.getHeight()/3.46,this.getHeight()/2.04,this.getHeight()/3.46);
this.graphics.setColor( "#e4f7df" );
//this.graphics.fillPolygon(x_tri,y_tri);
this.graphics.setColor("#4aa533");
this.graphics.drawPolygon(x_tri,y_tri);
this.graphics.paint();

/*Code Added to Dynamically shift Ports on resizing of shapes
 **/
if(this.input1!=null){
this.input1.setPosition(0,this.height/2);
}
if(this.output1!=null){
this.output1.setPosition(this.width/2,this.height);
}
if(this.input2!=null){
this.input2.setPosition(this.width/2,0);
}
if(this.output2!=null){
this.output2.setPosition(this.width,this.height/2);
}
};

bpmnEventMessageStart.prototype.setWorkflow=function(_40c5){
VectorFigure.prototype.setWorkflow.call(this,_40c5);
if(_40c5!=null){
    var eventPortName = ['output1','output2'];
    var eventPortType = ['OutputPort','OutputPort'];
    var eventPositionX= [this.width/2,this.width];
    var eventPositionY= [this.height,this.height/2];

    for(var i=0; i< eventPortName.length ; i++){
        eval('this.'+eventPortName[i]+' = new '+eventPortType[i]+'()');                               //Create New Port
        eval('this.'+eventPortName[i]+'.setWorkflow(_40c5)');                                        //Add port to the workflow
        eval('this.'+eventPortName[i]+'.setName("'+eventPortName[i]+'")');                            //Set PortName
        eval('this.'+eventPortName[i]+'.setZOrder(-1)');                                             //Set Z-Order of the port to -1. It will be below all the figure
        eval('this.'+eventPortName[i]+'.setBackgroundColor(new Color(255, 255, 255))');              //Setting Background of the port to white
        eval('this.'+eventPortName[i]+'.setColor(new Color(255, 255, 255))');                        //Setting Border of the port to white
        eval('this.addPort(this.'+eventPortName[i]+','+eventPositionX[i]+', '+eventPositionY[i]+')');  //Setting Position of the port
     }
}
};

bpmnEventMessageStart.prototype.getContextMenu=function(){
if(this.id != null){
   this.workflow.handleContextMenu(this);
}
};
