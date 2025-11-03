function GetAPIItems(){
  console.log("test");
  $.ajax({type: "GET",url: "https://www.doctorwhofans.be/php/API_Items.php",dataType: 'json',cache: false})
      .done(
          function (resultaat) {
            $('#API__Items').html(BuildCollapsibleList(resultaat.data));
             // GetListLinks(resultaat['LinksInContent'],resultaat['AllLinks']);
          }).fail(function (response, statusText, xhr) {}).always(function () {});


}


function renderAttributeForm(itemId, containerId) {
  const container = document.getElementById(containerId);
  if (!container) return;

  container.innerHTML = 'Loading form...';

  fetch(`https://www.doctorwhofans.be/php/API_MissingAttributes.php?id=${itemId}`)
    .then(res => res.json())
    .then(data => {
      const attributes = data.data;
      if (!Array.isArray(attributes) || attributes.length === 0) {
        container.innerHTML = '<p class="text-success">All attributes are already set for this item.</p>';
        return;
      }

      const form = document.createElement('form');
      form.id = `form-attributes-${itemId}`;
      form.className = 'form-horizontal';

      attributes.forEach(attr => {
        const fieldWrapper = document.createElement('div');
        fieldWrapper.className = 'form-group';

        const label = document.createElement('label');
        label.className = 'control-label col-sm-3';
        label.innerText = attr.Attribute;
        label.setAttribute('for', `attr-${attr.AttributeID}`);
        fieldWrapper.appendChild(label);

        const inputCol = document.createElement('div');
        inputCol.className = 'col-sm-9';

        let input;
        const id = `attr-${attr.AttributeID}`;

        switch (attr.ValidationRuleType) {
          case 'text':
            input = document.createElement('input');
            input.type = 'text';
            input.className = 'form-control';
            break;

          case 'number':
            input = document.createElement('input');
            input.type = 'number';
            input.className = 'form-control';
            break;

          case 'datetime':
            input = document.createElement('input');
            input.type = 'datetime-local';
            input.className = 'form-control';
            break;

          case 'boolean':
            input = document.createElement('select');
            input.className = 'form-control';
            input.innerHTML = `
              <option value="">Select...</option>
              <option value="1">Yes</option>
              <option value="0">No</option>
            `;
            break;

          case 'lookup':
            input = document.createElement('select');
            input.className = 'form-control';
            input.innerHTML = `<option value="">Select...</option>`;
            if (Array.isArray(attr.Options)) {
              attr.Options.forEach(opt => {
                const option = document.createElement('option');
                option.value = opt.value;
                option.textContent = opt.label;
                input.appendChild(option);
              });
            }
            break;

          default:
            input = document.createElement('input');
            input.type = 'text';
            input.className = 'form-control';
            break;
        }

        input.name = `attr[${attr.AttributeID}]`;
        input.id = id;

        inputCol.appendChild(input);
        fieldWrapper.appendChild(inputCol);
        form.appendChild(fieldWrapper);
      });

      // Submit Button
      const submitGroup = document.createElement('div');
      submitGroup.className = 'form-group';
      const submitCol = document.createElement('div');
      submitCol.className = 'col-sm-offset-3 col-sm-9';

      const submitBtn = document.createElement('button');
      submitBtn.type = 'submit';
      submitBtn.className = 'btn btn-primary';
      submitBtn.textContent = 'Save Attributes';

      submitCol.appendChild(submitBtn);
      submitGroup.appendChild(submitCol);
      form.appendChild(submitGroup);

      container.innerHTML = ''; // Clear loading
      container.appendChild(form);

      // Form submission (optional)
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(form);
        formData.append('ItemID', itemId);

        fetch('https://www.doctorwhofans.be/php/API_SaveAttributes.php', {
          method: 'POST',
          body: formData
        })
          .then(res => res.json())
          .then(response => {
            if (response.success) {
              container.innerHTML = '<p class="text-success">Attributes saved successfully.</p>';
            } else {
              container.innerHTML = `<p class="text-danger">Error: ${response.message || 'Failed to save.'}</p>`;
            }
          })
          .catch(() => {
            container.innerHTML = '<p class="text-danger">Error saving attributes.</p>';
          });
      });
    })
    .catch(() => {
      container.innerHTML = '<p class="text-danger">Failed to load attribute form.</p>';
    });
}

function loadItemDetails(itemId, targetId) {
  const panelCollapse = document.getElementById(targetId);
  if (!panelCollapse) return;

  const detailsContainer = panelCollapse.querySelector('.extended-details');

  //if (!detailsContainer || detailsContainer.dataset.loaded === "true") return;

  detailsContainer.innerHTML = 'Loading details...';

  fetch(`https://www.doctorwhofans.be/php/API_Item.php?id=${itemId}`)
    .then(response => response.json())
    .then(data => {
      const attributes = data.data; // **Here: data is already an array**

      console.log('Attributes:', attributes);

      if (!Array.isArray(attributes)) {
        console.error('Attributes is not an array');
      } else if (attributes.length === 0) {
        console.warn('Attributes array is empty');
      };


      if (!Array.isArray(attributes) || attributes.length === 0) {
        detailsContainer.innerHTML = '<p class="text-muted">No details found.</p>';
      }

      let html = '<ul class="list-unstyled">';
      attributes.forEach(attr => {
        let value =
          attr.Value ??
          attr.NumberValue ??
          attr.DateValue ??
          (attr.BoolValue !== null ? (attr.BoolValue ? 'Yes' : 'No') : null) ??
          attr.LookupValue ??
          '—';

        html += `<li><strong>${attr.Attribute} (${attr.Rule}):</strong> ${value}</li>`;
      });
      html += '</ul>';

      // Add a placeholder for the form below the details
      html += `<hr><div id="form-container-${itemId}">Loading missing fields...</div>`;

      detailsContainer.innerHTML = html;
      detailsContainer.dataset.loaded = "true";

      const img = panelCollapse.querySelector('img.lazy-image[data-src]');
if (img) {
  img.src = img.dataset.src;
  img.removeAttribute('data-src');
}

      // Load form for missing attributes
      renderAttributeForm(itemId, `form-container-${itemId}`);
    })
    .catch(() => {
      detailsContainer.innerHTML = '<p class="text-danger">Failed to load details.</p>';
    });
}





















































function BuildCollapsibleList(Items) {
  const parentId = "collapsibleAccordion";
  let html = `<div class="panel-group" id="${parentId}">`;

  for (let i = 0; i < Items.length; i++) {
    const item = Items[i];
    const targetId = `API__Item__Data__${item.ItemID}`;

    html += `
      <div class="panel panel-default">
        <div class="panel-heading" data-item-id="${item.ItemID}">
          <h4 class="panel-title">
            <a href="#${targetId}" data-toggle="collapse" onclick="loadItemDetails(${item.ItemID}, '${targetId}')">${item.Name}
            </a><span class="badge">${item.ContentType}</span>
          </h4>
        </div>
        <div id="${targetId}" class="panel-collapse collapse" data-item-id="${item.ItemID}">
          <div class="panel-body">
            <img class="lazy-image" style="width:13vw; float:right;" data-src="https://www.doctorwhofans.be/images/api__serials/${item.Image}" alt="${item.Name}" />
            <div class="extended-details">Loading details...</div>
            <div id="form-container-${item.ItemID}"></div>

          </div>
        </div>
      </div>
    `;
  }

  html += `</div>`;
  return html;
}