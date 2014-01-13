// Create the application
App = Ember.Application.create();

// Model for the application
var matrix = [
    {
        rows: 1,
        cols: 1,
        table: ""
    }
]

// Create routes
App.Router.map(function(){
	this.resource("home");
    this.resource("about");
});

// Add model to the index route
App.IndexRoute = Ember.Route.extend({
    model: function(params) {
        return matrix;
    }
});

// Add controller to the index route
App.IndexController = Ember.ObjectController.extend({

    // Add method to the controller
    submitAction : function(){
       $.ajax({
            type : 'POST',
            url : 'table.php',           
            data: {
                ok : true,
                rows : this.get("model.rows"),
                cols : this.get("model.cols"),
            },
            success: function (data) {
                 matrix.set('table', data);
            }          
        });      
    }
});




