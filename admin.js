function addPlace() {
  const placeName = document.getElementById('placeName').value;
  const description = document.getElementById('description').value;
  const photos = document.getElementById('photos').files;
  const uploadLocation = document.getElementById('uploadLocation').value;

  const newContent = {
    name: placeName,
    description: description,
    photos: Array.from(photos).map(file => URL.createObjectURL(file))
  };

  switch (uploadLocation) {
    case 'experience':
      addExperienceContent(newContent);
      break;
    case 'historicalLandsite':
      addHistoricalLandsiteContent(newContent);
      break;
    case 'historicalTouristSite':
      addHistoricalTouristSiteContent(newContent);
      break;
    case 'livelihoods':
      addLivelihoodsContent(newContent);
      break;
    case 'recreationalActivities':
      addRecreationalActivitiesContent(newContent);
      break;
    default:
      alert('Invalid upload location');
  }
}

function deletePlace() {
  // Logic to delete a place
  alert('Delete place functionality to be implemented.');
}

function updatePlace() {
  // Logic to update a place
  alert('Update place functionality to be implemented.');
}

function addExperienceContent(content) {
  const container = document.getElementById('experienceContent');
  const newContent = document.createElement('div');
  newContent.innerHTML = `
    <h3>${content.name}</h3>
    <p>${content.description}</p>
    <div class="photos">
      ${content.photos.map(photo => `<img src="${photo}" alt="${content.name} photo">`).join('')}
    </div>
  `;
  container.appendChild(newContent);
}

function addHistoricalLandsiteContent(content) {
  const container = document.getElementById('historicalLandsiteContent');
  const newContent = document.createElement('div');
  newContent.innerHTML = `
    <h3>${content.name}</h3>
    <p>${content.description}</p>
    <div class="photos">
      ${content.photos.map(photo => `<img src="${photo}" alt="${content.name} photo">`).join('')}
    </div>
  `;
  container.appendChild(newContent);
}

function addHistoricalTouristSiteContent(content) {
  const container = document.getElementById('historicalTouristSiteContent');
  const newContent = document.createElement('div');
  newContent.innerHTML = `
    <h3>${content.name}</h3>
    <p>${content.description}</p>
    <div class="photos">
      ${content.photos.map(photo => `<img src="${photo}" alt="${content.name} photo">`).join('')}
    </div>
  `;
  container.appendChild(newContent);
}

function addLivelihoodsContent(content) {
  const container = document.getElementById('livelihoodsContent');
  const newContent = document.createElement('div');
  newContent.innerHTML = `
    <h3>${content.name}</h3>
    <p>${content.description}</p>
    <div class="photos">
      ${content.photos.map(photo => `<img src="${photo}" alt="${content.name} photo">`).join('')}
    </div>
  `;
  container.appendChild(newContent);
}

function addRecreationalActivitiesContent(content) {
  const container = document.getElementById('recreationalActivitiesContent');
  const newContent = document.createElement('div');
  newContent.innerHTML = `
    <h3>${content.name}</h3>
    <p>${content.description}</p>
    <div class="photos">
      ${content.photos.map(photo => `<img src="${photo}" alt="${content.name} photo">`).join('')}
    </div>
  `;
  container.appendChild(newContent);
}
