/*---------------------------------------------------------------------------------------*/
function HeightWidth() {

	var clientWidth = Ext.lib.Dom.getViewportWidth();
	var clientHeight = Ext.lib.Dom.getViewportHeight();
	
	var headerHeight = Ext.get("header").getHeight();
	
	Ext.get("header").setWidth(clientWidth);
	Ext.get("copyright").setWidth(clientWidth);
	Ext.get("main").setHeight(clientHeight - headerHeight - 140);
	Ext.get("main").setWidth(clientWidth);

}
/*---------------------------------------------------------------------------------------*/
Ext.onReady(function() {
	HeightWidth();
	Ext.fly(window).on("resize", HeightWidth);
});
/*---------------------------------------------------------------------------------------*/