import { createSlice, createAsyncThunk } from '@reduxjs/toolkit';
import {
  fetchAmenities as fetchAmenitiesService,
  addAmenity as addAmenityService,
  deleteAmenity as deleteAmenityService,
  updateAmenity as updateAmenityService,
} from '../services/amenity';

export const fetchAmenities = createAsyncThunk(
  'amenities/fetchAmenities',
  async () => {
    return fetchAmenitiesService();
  }
);

export const addAmenity = createAsyncThunk(
  'amenities/addAmenity',
  async (data) => {
    return addAmenityService(data);
  }
);

export const updateAmenity = createAsyncThunk(
  'amenities/updateAmenity',
  async ({ slug, data }) => {
    return updateAmenityService(slug, data);
  }
);

export const deleteAmenity = createAsyncThunk(
  'amenities/deleteAmenity',
  async (slug) => {
    await deleteAmenityService(slug);
    return slug;
  }
);

const amenitiesSlice = createSlice({
  name: 'amenities',
  initialState: {
    amenities: [],
    status: 'idle',
    error: null,
  },
  reducers: {},
  extraReducers: (builder) => {
    builder
      .addCase(fetchAmenities.pending, (state) => {
        state.status = 'loading';
      })
      .addCase(fetchAmenities.fulfilled, (state, action) => {
        state.status = 'succeeded';
        state.amenities = action.payload;
      })
      .addCase(fetchAmenities.rejected, (state, action) => {
        state.status = 'failed';
        state.error = action.error.message;
      })
      .addCase(addAmenity.fulfilled, (state, action) => {
        state.amenities.push(action.payload);
      })
      .addCase(deleteAmenity.fulfilled, (state, action) => {
        state.amenities = state.amenities.filter(
          (amenity) => amenity.slug !== action.payload
        );
      })
      .addCase(updateAmenity.fulfilled, (state, action) => {
        const index = state.amenities.findIndex(
          (amenity) => amenity.slug === action.meta.arg.slug
        );
        if (index !== -1) {
          state.amenities[index] = action.payload;
        }
      });
  },
});

export default amenitiesSlice.reducer;
