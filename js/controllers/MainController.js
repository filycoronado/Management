app.controller('MainController', ['$rootScope', '$cookies', '$scope', '$filter', '$routeParams', '$http', '$timeout', function ($rootScope, $cookies, $scope, $filter, $routeParams, $http, $timeout) {
        $rootScope.username = $cookies.get('username');
        $rootScope.total_transactions = 0;
        $rootScope.TotalActives = 0;
        $rootScope.URL="Server/APIGYM//Backend/web/";
        $scope.user_local = angular.fromJson(localStorage.getItem("USER"));

        if ($rootScope.username == null) {

            location.href = './login.html';
            $location.replace();
        } else {
            
        }


        $scope.DologOut = function () {

            $http.post('./Backend/web/index.php?r=api/remove_session', {user: $scope.user}).then(function success(response) {
                $cookies.remove('username');
                localStorage.removeItem('USER');
                location.href = './login.html';
                $location.replace();
            });


        };


        $http.get('./Backend/web/index.php?r=api/transaction_user').then(function success(response) {
            $rootScope.total_transactions = response.data.length;
        });

        $http.get('./Backend/web/index.php?r=api/get_customer_actives').then(function success(response) {
            $rootScope.TotalActives = response.data.length;
        });
    }]);