/*******************************************/
/**      author:  hoho                   **/
/**      http://www.thinkcart.net        **/
/******************************************/

function tree(id){
    this.obj = $('#'+id);
    this.btn = this.obj.find('.btn');
    this.moveHandler = null;
    this.move = function(){
        this.btn.hide();
        this.obj.attr('class','moveRight');
        var obj = this.obj;
        this.moveHandler = setInterval(function(){
            if(obj.hasClass('moveLeft')){
                obj.attr('class','moveRight');
            }else{
                obj.attr('class','moveLeft');
            }
        },100);
    };
    this.stop = function(){
        clearInterval(this.moveHandler);
        this.obj.attr('class','stop');
    };
    this.recover = function(){
        clearInterval(this.moveHandler);
        this.btn.show();
        this.obj.attr('class','normal');
    };
}

award_id = 0; //奖品ID
award_name = '';//中奖名称
function start_lottery(){
	var myTree = new tree('tree');
	myTree.move();
	var a = new Array('神仙姐姐', '如花', '芙蓉姐姐', '凤姐');
	award_id = Math.floor((Math.random()*a.length));//得到奖品ID
	award_id = award_id +1;
	award_name = "神仙姐姐";//得到奖品名称
	setTimeout(function(){
		myTree.stop();
		effect.zoomIn('award_'+award_id,1); 
	},3000);
	setTimeout(function(){myTree.recover();},8000);

}