if (document.readyState == "loading"){
    document.addEventListener('DOMContentLoaded', ready)
}else {
    ready();
}

function ready() {

var fetureMainContent = document.getElementsByClassName('productFeatureContent')[0];
var addFeatureGroupBtn = document.getElementsByClassName('addFeatureGroupBtn')[0];
    addFeatureGroupBtn.addEventListener('click', addFeatureGroup);
    var base_url = window.location.origin;

    function addFeatureGroup(){
        $('.productFeatureContent').append('<div class="featureGroupContent">\n' +
            '    <div align="right" class="pt-2">\n' +
            '        <a href="javascript:void(0);" class="removeFeatureGroupBtn" style="margin-bottom: 0;"><img src="'+ base_url+'/Media/image/remove-icon.png"></a>\n' +
            '    </div>\n' +
            '    <label for="productFeatureGroup">Feature Group Name</label>\n' +
            '    <input type="text" id="productFeatureGroup"  class="form-control form-control-rounded featureGroupName" name="feature_group_name[]" value="" placeholder="Feature Group Name" required/>\n' +
            '\n' +
            '    <div class="addFeatureBtnContent py-2">\n' +
            '        <button type="button" class="btn btn-warning w-50 addFeatureBtn">Add Feature</button>\n' +
            '    </div>\n' +
            '\n' +
            '    <div class="col-sm-12 featureContent">\n' +
            '\n' +
            '    </div>\n' +
            '</div>');

        var featureContent = document.getElementsByClassName('featureGroupContent');


        for(var i = 0; i < featureContent.length; i++){
            var featureAddBtn = featureContent[i].getElementsByClassName('addFeatureBtn')[0];

            featureAddBtn.addEventListener('click', features);
        }

        var removeFeatureGroupBtn = document.getElementsByClassName('removeFeatureGroupBtn');
        for(var i = 0; i < removeFeatureGroupBtn.length; i++){
            var btn = removeFeatureGroupBtn[i];
            btn.addEventListener('click', removeFeatureGroup);
        }
    }

    function removeFeatureGroup(event){
        var button = event.target;
        button.parentElement.parentElement.parentElement.remove();
    }

    function features(event){
        var button = event.target;
        var faetureContent = button.parentElement.parentElement;
        var fratureGroupName = faetureContent.getElementsByClassName('featureGroupName')[0].value;
        if(fratureGroupName != ''){
            addFeatures(event, fratureGroupName);
        }else{

            faetureContent.getElementsByClassName('featureGroupName')[0].focus();
        }
    }

    function addFeatures(event, fratureGroupName){
        var button = event.target;
        var faetureContent = button.parentElement.parentElement.getElementsByClassName('featureContent')[0];

        var content = document.createElement('biv');
        content.classList.add('singleFeature');

        var inputBox = fratureGroupName.replace(/\s/g,'');

        var singleFeatureContentItem = '<div align="right">\n' +
            '        <a href="javascript:void(0);" class="removeFeatureBtn" style="margin-bottom: 0;"><img src="'+ base_url+'/Media/image/remove-icon.png"></a>\n' +
            '    </div>\n' +
            '    <label for="'+inputBox+'Name">Feature Name</label>\n' +
            '    <input type="text" id="featureName"  class="form-control form-control-rounded '+inputBox+'Name" name="'+ inputBox +'_name[]" value="" placeholder="Feature Name" required/>\n' +
            '\n' +
            '    <label for="'+inputBox+'Material">Feature Material</label>\n' +
            '    <input type="text" id="featureMaterial" class="form-control form-control-rounded '+inputBox+'Material" name="'+ inputBox +'_material[]" value="" placeholder="Feature Material" required/>'
        content.innerHTML = singleFeatureContentItem;

        faetureContent.append(content);

        var removeFeatureBtn = document.getElementsByClassName('removeFeatureBtn');
        for(var i = 0; i < removeFeatureBtn.length; i++){
            var btn = removeFeatureBtn[i];
            btn.addEventListener('click', removeFeature);
        }
    }

    function removeFeature(event){
        var button = event.target;
        button.parentElement.parentElement.parentElement.remove();
    }
}
