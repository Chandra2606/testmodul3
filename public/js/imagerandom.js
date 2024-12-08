// Debugging helper
function logCategoryInfo(category) {
    console.group("Category Info");
    console.log("Raw category:", category);
    console.log("Type:", typeof category);
    console.log("Length:", category ? category.length : 0);
    console.groupEnd();
}

const categoryImages = {
    Programming: [
        "https://images.unsplash.com/photo-1461749280684-dccba630e2f6",
        "https://images.unsplash.com/photo-1498050108023-c5249f4df085",
    ],
    Framework: [
        "https://images.unsplash.com/photo-1633356122544-f134324a6cee",
        "https://images.unsplash.com/photo-1517180102446-f3ece451e9d8",
    ],
    Technology: [
        "https://images.unsplash.com/photo-1518770660439-4636190af475",
        "https://images.unsplash.com/photo-1531297484001-80022131f5a1",
    ],
    default: [
        "https://images.unsplash.com/photo-1599507593499-a3f7d7d97667?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8cHJvZ3JhbW1pbmd8ZW58MHx8MHx8fDA%3D",
    ],
};

// Debug function
function debugCategory(category, element) {
    console.group('Category Debug');
    console.log('Category received:', category);
    console.log('Element data-category:', element.dataset.category);
    console.log('Available categories:', Object.keys(categoryImages));
    console.groupEnd();
}

function getImageByCategory(category) {
    debugCategory(category, document.querySelector(`[data-category="${category}"]`));

    // Normalize category name to match exactly what's in the database
    const normalizedCategory = category.charAt(0).toUpperCase() + category.slice(1);
    console.log('Normalized category:', normalizedCategory);

    // Check if category exists in our images object
    if (categoryImages[normalizedCategory]) {
        console.log('Found matching category:', normalizedCategory);
        const images = categoryImages[normalizedCategory];
        return images[Math.floor(Math.random() * images.length)];
    }

    console.log('No matching category found, using default');
    return categoryImages['default'][0];
}

document.addEventListener('DOMContentLoaded', function() {
    console.clear(); // Clear previous console logs
    console.log('DOM Loaded - Initializing Images');
    
    const articleImages = document.querySelectorAll('.article-image');
    console.log('Found article images:', articleImages.length);
    
    articleImages.forEach((img, index) => {
        const category = img.dataset.category;
        console.log(`\nProcessing Image ${index + 1}`);
        console.log('Raw category value:', category);
        
        if (!category || category === 'default') {
            console.log('Using default image');
            img.src = categoryImages['default'][0];
        } else {
            console.log('Getting image for category:', category);
            img.src = getImageByCategory(category);
        }
        
        // Log final src
        console.log('Final image src:', img.src);
    });
});
