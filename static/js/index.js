// INICIO TEMA

const LOCAL_KEY = "theme";
const DEFAULT_THEME = "light";
const NON_DEFAULT_THEME = "dark";
const DARK_DECORATOR = "dark-theme";

let theme = DEFAULT_THEME;

// On load => load theme.
loadStorageTheme();

function changeTheme(newTheme) {
	console.log(newTheme);
	if (newTheme == DEFAULT_THEME)
		document.documentElement.classList.remove(DARK_DECORATOR);
	else document.documentElement.classList.add(DARK_DECORATOR);
}

function loadStorageTheme() {
	const localTheme = localStorage.getItem(LOCAL_KEY);
	changeTheme(localTheme);
}

function toggleTheme() {
	theme = theme === DEFAULT_THEME ? NON_DEFAULT_THEME : DEFAULT_THEME;
	localStorage.setItem(LOCAL_KEY, theme);
	changeTheme(theme);
}

// FIN TEMA



