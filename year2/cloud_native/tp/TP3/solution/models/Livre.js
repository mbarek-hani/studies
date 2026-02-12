import mongoose from "mongoose";

const livreSchema = mongoose.Schema({
    titre:{
        required:true,
        type:String,
        trim: true
    },
    pages:{
        required: true,
        type: Number,
        min:0,
    },
    genre:{
        required: true,
        type: String,
        default: 'book',
        enum:['e-book', 'book', 'manga']
    },
    disponible:{
        default: true,
        type: Boolean
    }
},{
    timestamps: true
});

export default mongoose.model('Livre', livreSchema);