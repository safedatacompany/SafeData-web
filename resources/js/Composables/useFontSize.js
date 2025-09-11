import { ref, computed, watch, onMounted } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

export function useFontSettings() {
    const fontScale = ref('medium') // Default fallback
    const fontWeight = ref('normal') // Default fallback
    const isLoading = ref(false)

    // Available font scale options
    const fontScales = [
        { id: 1, name: 'Extra Small', value: 'xs' },
        { id: 2, name: 'Small', value: 'small' },
        { id: 3, name: 'Medium', value: 'medium' },
        { id: 4, name: 'Large', value: 'large' },
        { id: 5, name: 'Extra Large', value: 'xl' },
        { id: 6, name: '2X Large', value: '2xl' },
        { id: 7, name: '3X Large', value: '3xl' },
    ]

    // Available font weight options
    const fontWeights = [
        { id: 1, name: 'Thin', value: '100' },
        { id: 2, name: 'Extra Light', value: '200' },
        { id: 3, name: 'Light', value: '300' },
        { id: 4, name: 'Normal', value: '400' },
        { id: 5, name: 'Medium', value: '500' },
        { id: 6, name: 'Semi Bold', value: '600' },
        { id: 7, name: 'Bold', value: '700' },
        { id: 8, name: 'Extra Bold', value: '800' },
        { id: 9, name: 'Black', value: '900' },
    ]

    // Computed properties
    const currentScale = computed(() =>
        fontScales.find(s => s.value === fontScale.value)
    )
    const scaleOptions = computed(() => fontScales)
    const currentWeight = computed(() =>
        fontWeights.find(w => w.value === fontWeight.value)
    )
    const weightOptions = computed(() => fontWeights)

    // Apply font scale and weight to document
    const applyFontSettings = (scale, weight) => {
        document.documentElement.setAttribute('data-font-scale', scale)
        document.documentElement.setAttribute('data-font-weight', weight)
        
        // Also update CSS custom properties for backup
        document.documentElement.style.setProperty('--font-scale', getScaleValue(scale))
        document.documentElement.style.setProperty('--font-weight', weight)
    }

    // Helper function to get numeric scale value
    const getScaleValue = (scaleKey) => {
        const scaleMap = {
            'xs': '0.75',
            'small': '0.875', 
            'medium': '1',
            'large': '1.125',
            'xl': '1.25',
            '2xl': '1.375',
            '3xl': '1.5'
        }
        return scaleMap[scaleKey] || '1'
    }

    // Save font preference to backend
    const saveFontPreference = async (scale, weight) => {
        try {
            isLoading.value = true
        } catch (error) {
            console.error('Failed to save font preference:', error)
        } finally {
            isLoading.value = false
        }
    }

    // Update font scale
    const setFontScale = async (scaleValue) => {
        const scale = typeof scaleValue === 'object' ? scaleValue.value : scaleValue
        if (fontScales.some(s => s.value === scale)) {
            fontScale.value = scale
            applyFontSettings(scale, fontWeight.value)
            localStorage.setItem('fontScale', scale)
            await saveFontPreference(scale, fontWeight.value)
        }
    }

    // Update font weight
    const setFontWeight = async (weightValue) => {
        const weight = typeof weightValue === 'object' ? weightValue.value : weightValue
        // Convert weight to string for consistent comparison
        const weightStr = String(weight)
        if (fontWeights.some(w => w.value === weightStr)) {
            fontWeight.value = weightStr
            applyFontSettings(fontScale.value, weightStr)
            localStorage.setItem('fontWeight', weightStr)
            await saveFontPreference(fontScale.value, weightStr)
        }
    }

    // Load font preference
    const loadFontPreference = () => {
        const userSetting = usePage().props.auth?.user?.user_setting
        const userScale = userSetting?.font_scale
        const userWeight = userSetting?.font_weight
        const localScale = localStorage.getItem('fontScale')
        const localWeight = localStorage.getItem('fontWeight')

        // Priority: localStorage > user settings > defaults
        const scalePref = localScale || userScale || 'medium'
        const weightPref = String(localWeight || userWeight || '400')

        fontScale.value = scalePref
        fontWeight.value = weightPref

        // Apply immediately
        applyFontSettings(scalePref, weightPref)
    }

    watch(fontScale, (newScale) => {
        applyFontSettings(newScale, fontWeight.value)
    })

    watch(fontWeight, (newWeight) => {
        applyFontSettings(fontScale.value, newWeight)
    })

    onMounted(() => {
        loadFontPreference()
        applyFontSettings(fontScale.value, fontWeight.value)
    })

    return {
        fontScale,
        fontWeight,
        currentScale,
        scaleOptions,
        currentWeight,
        weightOptions,
        isLoading,
        setFontScale,
        setFontWeight,
        loadFontPreference
    }
}