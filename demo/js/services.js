materialAdmin

    // =========================================================================
    // Header Messages and Notifications list Data
    // =========================================================================

    .service('messageService', ['$resource', function($resource){
        this.getMessage = function(img, user, text) {
            var gmList = $resource("data/messages-notifications.json");
            
            return gmList.get({
                img: img,
                user: user,
                text: text
            });
        }
    }])
    

    // =========================================================================
    // Best Selling Widget Data (Home Page)
    // =========================================================================

    .service('bestsellingService', ['$resource', function($resource){
        this.getBestselling = function(img, name, range) {
            var gbList = $resource("data/best-selling.json");
            
            return gbList.get({
                img: img,
                name: name,
                range: range,
            });
        }
    }])

    
    // =========================================================================
    // Todo List Widget Data
    // =========================================================================

    .service('todoService', ['$resource', function($resource){
        this.getTodo = function(todo) {
            var todoList = $resource("data/todo.json");
            
            return todoList.get({
                todo: todo
            });
        }
    }])


    // =========================================================================
    // Province List Widget Data
    // =========================================================================

    .service('provinceService', ['$resource', function($resource){
        this.getProvince = function(province) {
            var provinceList = $resource("database/province.json");
            
            return provinceList.get({
                name: name
            });
        }
    }])


    // =========================================================================
    // Recent Items Widget Data
    // =========================================================================
    
    .service('recentitemService', ['$resource', function($resource){
        this.getRecentitem = function(id, name, price) {
            var recentitemList = $resource("data/recent-items.json");
            
            return recentitemList.get ({
                id: id,
                name: name,
                price: price
            })
        }
    }])


    // =========================================================================
    // Recent Posts Widget Data
    // =========================================================================
    
    .service('recentpostService', ['$resource', function($resource){
        this.getRecentpost = function(img, user, text) {
            var recentpostList = $resource("data/messages-notifications.json");
            
            return recentpostList.get ({
                img: img,
                user: user,
                text: text
            })
        }
    }])


    // =========================================================================
    // Nice Scroll - Custom Scroll bars
    // =========================================================================
    .service('nicescrollService', function() {
        var ns = {};
        ns.niceScroll = function(selector, color, cursorWidth, background) {
            $(selector).niceScroll({
                background: background,
                cursorcolor: color,
                cursorborder: 0,
                cursorborderradius: 0,
                cursorwidth: cursorWidth,
                bouncescroll: true,
                mousescrollstep: 100,
                autohidemode: false
            });
        }
        
        return ns;
    })


    //==============================================
    // BOOTSTRAP GROWL
    //==============================================
    //EDITADO POR GONZA
    .service('growlService', function(){
        var gs = {};
        gs.growl = function(message, type, animate, url) {
            url = url || "";
            animateIn = animate? animate.in : "bounceIn";
            animateOut = animate? animate.out : "bounceOut";
            $.growl({
                message: message,
                url: url,
            },{
                url_target: "/tpaqcake/users/profile/31",
                url: "/tpaqcake/users/profile/31",
                type: type,
                allow_dismiss: true,
                label: 'Cancel',
                className: 'btn-xs btn-inverse',
                placement: {
                    from: 'top',
                    align: 'right'
                },
                delay: 5000,
                animate: {
                        enter: 'animated '+ animateIn,
                        exit: 'animated '+animateOut
                },
                offset: {
                    x: 20,
                    y: 85
                }
            });
        }
        
        return gs;
    })

    //==============================================
    // 
    //==============================================

    .service('requestData', function($http, $q){
    	
        var getAll = function(url) {
            var defered = $q.defer();

            $http.get(url)
                .success(function(data) {
                    defered.resolve(data)
                })
                .error(function(err) {
                    defered.reject(error)
                });

        	return defered.promise;
        }

        return {
    		getAll: getAll
    	}
        
    })

    .service('MyService', function($http) {
        var myData = null;

        var promise = $http.get('http://www.travelpaq.com.ar/tpaq/users/add').success(function (data) {
          myData = data;
        });

        return {
          promise:promise,
          setData: function (data) {
              myData = data;
          },
          doStuff: function () {
              return myData;//.getSomeData();
          }
        };
    })


.service('AccessService', ['$location, $rootScope', function($location, $rootScope){
    obj = {};

    obj.authorizedRoles = function(roles) {
        var role = angular.fromJson(localStorage.session_data).User.role;
        var isAuthorized = angular.fromJson(localStorage.session_data).isAuthorized;
        console.log(role);
        console.log(isAuthorized);
        if (!isAuthorized || (roles.indeOf(role) == -1)) {
            $location.path('/login');
            swal('Acceso denegado!', 'error');
        };
    }

    return obj;
}])