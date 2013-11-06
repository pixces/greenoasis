Array.prototype.where = function (conditions) {//[object pointer in array{ a, Address.City, Employee.Designation etc....}, conditional operator, valueto match, next condition operator {AND /OR}
    var ret = false;
    var retArr = [];
    var obj = null;
    for (var i = 0; i < this.length; i++) {
        for (var j = 0; j < conditions.length; j++) {
            obj = (function (root, elem) {
                var out = null;
                elem = elem.split(".");
                for (var i = 0; i < elem.length; i++)
                    root = root[elem[i]];
                return root
            })(this[i], conditions[j][0])
            console.log(typeof(obj));
            conditions[j][2] = eval('(typeof(' + conditions[j][2] + '))') != 'undefined' ? conditions[j][2] : "'" + conditions[j][2] + "'";
            if (typeof(' + obj + ') == 'string') obj= "'" + obj + "'"
            
            console.log(obj);
            if (eval("(" + obj + conditions[j][1] + conditions[j][2] + ")"))
                retArr.push(this[i]);
        }
    }
    return retArr;
}

Array.prototype.groupBy = function (conditions) { //object pointer in array{ a, Address.City, Employee.Designation etc....}
    var retArr = [];
    var obj = null;
    var key = -1;
    for (var i = 0; i < this.length; i++) {
        obj = (function (root, elem) {
            var out = null;
            elem = elem.split(".");
            for (var i = 0; i < elem.length; i++)
                root = root[elem[i]];
            return root
        })(this[i], conditions)
        key = retArr.hasKey(obj);
        if (key > -1) {
            retArr[key].value.push(this[i]);
        }
        else {
            var kvp = {};
            kvp["key"] = obj;
            var valueArr = [];
            valueArr.push(this[i]);
            kvp["value"] = valueArr;
            retArr.push(kvp);
        }
    }
    return retArr;
}

Array.prototype.hasKey = function (val) {

    for (var i = 0; i < this.length; i++) {
        if(this[i].key=='undefined'){
        	console.log("no key")
           return -1
        }            if(this[i].key==val){
        	console.log("has key")
        	return i;

        } 
    }    
        console.log("has key")
        return -1;
    
}
