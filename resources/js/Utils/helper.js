export const getInitials = (name) => {
    let initials = name.match(/\b\w/g) || [];
    initials = ((initials.shift() || '') + (initials.pop() || '')).toUpperCase();
    return initials;
}

export const formatDate = (dateString) => {
    return dateString.substring(0, 10).split('-').reverse().join('-');
}

export const formatDateEnglish = (dateString, timezone) => {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const date = new Date(dateString);
    return date.toLocaleDateString("en-US", options);
}

export const isObjectValid = (object, nullableFields=[]) => {
  	for (const property in object) {
        if(nullableFields.indexOf(property) < 0 && !object[property]) return false;
	}
  	return true;
}
