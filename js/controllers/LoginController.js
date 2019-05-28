app.controller('LoginController', ['$rootScope', '$cookies', '$location', '$scope', '$filter', '$routeParams', '$http', '$timeout', function ($rootScope, $cookies, $location, $scope, $filter, $routeParams, $http, $timeout) {
        $scope.user = {};
        $scope.DoLogin = function (isValid) {
            if (isValid) {
                $http.post('./Backend/web/index.php?r=api/login_user', {user: $scope.user}).then(function success(response) {
                    $scope.response = response.data;
                    if ($scope.response.status == true) {
                        $cookies.put('username', $scope.user.username);
                        localStorage.setItem("USER", angular.toJson($scope.response.info));
                        location.href = './';
                        $location.replace();
                    } else {
                        alert("Login Error Check Credentials");
                    }
                });
            }
        };
}]);