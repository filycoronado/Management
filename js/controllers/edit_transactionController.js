app.controller('edit_transactionController', ['$rootScope', '$scope', '$filter', '$routeParams', '$http', '$timeout', function ($rootScope, $scope, $filter, $routeParams, $http, $timeout) {
        var id = $routeParams.id;
        $scope.ticket = {};
        $scope.companies = [];
        $scope.cashiers = [];
        $scope.agents = [];

        $http.get('./Backend/web/index.php?r=api/get_companies', {}).then(function success(response) {
            $scope.companies = response.data;
        });
        $http.get('./Backend/web/index.php?r=api/get_agents', {}).then(function success(response) {
            $scope.agents = response.data;
        });
        $http.get('./Backend/web/index.php?r=api/get_cashiers', {}).then(function success(response) {
            $scope.cashiers = response.data;
        });
        $http.post('./Backend/web/index.php?r=api/get_ticket_by_id', {id: id}).then(function success(response) {
            $scope.ticket = response.data;
            $scope.ticket.fecha = new Date($scope.ticket.fecha + "T12:00:00Z");
            $scope.ticket.agency = $scope.ticket.agency + "";
            $scope.ticket.company = $scope.ticket.company + "";
            $scope.ticket.id_usuario = $scope.ticket.id_usuario + "";
            $scope.ticket.id_cashier = $scope.ticket.id_cashier + "";
        });

        $scope.update_transaction = function (validate) {
            if (validate) {
                $http.post('./Backend/web/index.php?r=api/update_transaction', {id:id ,ticket: $scope.ticket}).then(function success(response) {
                    alert(response.data.message);
                });
            }
        }
    }]);