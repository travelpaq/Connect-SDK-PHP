//var materialAdmin = angular.module('materialAdmin', ['ngResource', 'ui.router', 'angular-loading-bar', 'oc.lazyLoad', 'stBlurredDialog']);
//var materialAdmin = angular.module('materialAdmin', ['ngResource','ya.nouislider', 'ui.bootstrap','angular-loading-bar','infinite-scroll','mgo-angular-wizard','ngAnimate']);
// var materialAdmin = angular.module('materialAdmin', ['ngResource','ya.nouislider', 'ui.bootstrap','angular-loading-bar','infinite-scroll','ngAnimate']);
var materialAdmin = angular.module('materialAdmin', ['ngResource','ya.nouislider', 'ui.bootstrap','angular-loading-bar','infinite-scroll']);

materialAdmin.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs.ngEnter);
                });
                event.preventDefault();
            }
        });
    };
});

materialAdmin.directive('pwCheck', function () {
    return {
      require: 'ngModel',
      link: function (scope, elem, attrs, ctrl) {
        var firstPassword = '#' + attrs.pwCheck;
        elem.add(firstPassword).on('keyup', function () {
          scope.$apply(function () {
            var v = elem.val()===$(firstPassword).val();
            ctrl.$setValidity('pwmatch', v);
          });
        });
      }
    }
  });

materialAdmin.directive('backButton', function(){
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            element.bind('click', function () {
                history.back();
                scope.$apply();
            });
        }
    }
});
materialAdmin.directive('stringToNumber', function() {
    return {
        require: 'ngModel',
        link: function(scope, element, attrs, ngModel) {
            ngModel.$parsers.push(function(value) {
                return '' + value;
            });
            ngModel.$formatters.push(function(value) {
                return parseFloat(value, 10);
            });
        }
    };
});

materialAdmin.filter('comma2decimal', function() { // should be altered to suit your needs
    return function(input) {
    var ret=(input)?input.toString().trim().replace(",","."):null;
        return parseFloat(ret);
    };
});

materialAdmin.filter('decimal2comma', function() {// should be altered to suit your needs
    return function(input) {
        var ret=(input)?input.toString().replace(".",","):null;
        if(ret){
            var decArr=ret.split(",");
            if(decArr.length>1){
                var dec=decArr[1].length;
                if(dec===1){ret+="0";}
            }//this is to show prices like 12,20 and not 12,2
        }
        return ret;
    };
});

materialAdmin.directive('price', ['$filter', function($filter) {
    return {
        restrict:'A',
        require: 'ngModel',
        link: function(scope, element, attrs, ngModelController) {
            ngModelController.$parsers.push(function(data) {
                //convert data from view format to model format

                data=$filter('comma2decimal')(data);

                return data;
            });

            ngModelController.$formatters.push(function(data) {
                //convert data from model format to view format

                data=$filter('decimal2comma')(data);

                return data;
            });
        }
    };
}]);

materialAdmin.run(function($rootScope) {
    $rootScope.appUrl = '/tpaqcake';
});
//Serializa las variables de la vista publicaciones
materialAdmin.factory("serialVar", function(){
var publiAux = [];
        var interfaz = {
        getArre: function(){
            return publiAux;
        },
        setArre: function(item){
            publiAux.push(item);
        },

        iniciar: function(){
            publiAux = [];
        },
        getIndice: function(){
            return publiAux.length;
        }
    }
    return interfaz;
});

materialAdmin.factory('msgBus', ['$rootScope', function($rootScope) {
        var msgBus = {};
        msgBus.emitMsg = function(msg,data) {
             data = data || {};
            $rootScope.$emit(msg,data);
        };
        msgBus.onMsg = function(msg, func,scope) {
            var unbind = $rootScope.$on(msg, func);
            if (scope) {
                scope.$on('$destroy', unbind);
            }
        };
        return msgBus;
    }]);

materialAdmin.directive('uppercaseOnly', [
  // Dependencies

  // Directive
  function() {
    return {
      restrict: 'A',
      require: 'ngModel',
      link: function(scope, element, attrs, ctrl) {
        element.on('keypress', function(e) {
          var char = e.char || String.fromCharCode(e.charCode);
          if (!/^[A-Z0-9]$/i.test(char)) {
            e.preventDefault();
            return false;
          }
        });

        function parser(value) {
          if (ctrl.$isEmpty(value)) {
            return value;
          }
          var formatedValue = value.toUpperCase();
          if (ctrl.$viewValue !== formatedValue) {
            ctrl.$setViewValue(formatedValue);
            ctrl.$render();
          }
          return formatedValue;
        }

        function formatter(value) {
            value = value.toString();
          if (ctrl.$isEmpty(value)) {
            return value;
          }
          return value.toUpperCase();
        }

        ctrl.$formatters.push(formatter);
        ctrl.$parsers.push(parser);
      }
    };
  }
]);
// materialAdmin.run(function($rootScope, $http) {

//     $rootScope.appUrl = '/tpaq';

//     $http.get($rootScope.appUrl + '/packages/request_data')
//         .success(function(data, status, headers, config) {
//             //Package data
//             $rootScope.packageRequestData = angular.fromJson(data);
            
//             //Hotel data
//             $rootScope.hotelRequestData = {"places":[]} ;
//             $rootScope.hotelRequestData.places = $rootScope.packageRequestData.places;
//         });

//     //Indicador de solicitudes de nuevos registros
//     $rootScope.registerIndicator = 0;
//     $rootScope.registeredContacts = {};

//     $http.get($rootScope.appUrl + '/contacts.json')
//         .success(function(data, status, headers, config) {
//             $rootScope.registeredContacts = data.contacts;
//             $rootScope.registerIndicator = $rootScope.registeredContacts ? $rootScope.registeredContacts.length : 0;
//             console.log($rootScope.registeredContacts);
//     });

//     $rootScope.listTransportCompany = {};
//     $rootScope.listCountry = {};
//     $rootScope.listRegion = {};
// });

